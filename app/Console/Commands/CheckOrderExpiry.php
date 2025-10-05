<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Inventory;
use Illuminate\Console\Command;
use App\Services\NotificationService;

class CheckOrderExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-order-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $expiredOrder = Order::with('orderProducts.product.inventory')->whereNotNull('expiry_date')->whereDate('expiry_date', '<', $today)->where('status', 'pending')->get();
        $notifier = app(NotificationService::class);

        foreach ($expiredOrder as $order) {
            $order->status = 'expired';
            $order->save();

            foreach ($order->orderProducts as $orderProduct) {
                $product = $orderProduct->product;
                $product->inventory->stock += $orderProduct->quantity;
                $product->inventory->save();
            }

            $notifier->createNotif(
                $order->user_id,
                'Order Expired',
                "The order {$order->reference_id} has expired.",
                ['admin', 'cashier', 'admin_officer'],
            );

            $this->info("Task ID {$order->id} has expired.");
        }

        $this->info('Checked for expired tasks.');
    }
}
