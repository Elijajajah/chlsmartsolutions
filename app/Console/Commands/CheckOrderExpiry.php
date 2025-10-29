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

        // Get all pending orders that have expired
        $expiredOrders = Order::with('productSerials')
            ->whereNotNull('expiry_date')
            ->whereDate('expiry_date', '<', $today)
            ->where('status', 'pending')
            ->get();

        $notifier = app(NotificationService::class);

        foreach ($expiredOrders as $order) {
            // Update order status
            $order->status = 'expired';
            $order->save();

            // Restore all product serials under this order to "available"
            $order->productSerials()->update(['status' => 'available']);

            // Send notification
            $notifier->createNotif(
                $order->user_id,
                'Order Expired',
                "The order {$order->reference_id} has expired.",
                ['owner', 'cashier', 'admin_officer'],
            );

            $this->info("Order ID {$order->id} ({$order->reference_id}) has expired and serials restored.");
        }

        $this->info('Checked for expired orders successfully.');
    }
}
