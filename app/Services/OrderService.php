<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function getFilteredOrders($status, $search = null)
    {
        $statusValue = match (true) {
            $status == 1 => 'pending',
            $status == 2 => 'completed',
            $status == 3 => 'expired',
            default => null,
        };

        return Order::query()
            ->when($statusValue, fn ($query) => $query->where('status', $statusValue))
            ->when($search, fn ($query) => $query->where('reference_id', 'like', '%' . $search . '%'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function countOrder($status)
    {
        return match ($status) {
            'pending' => Order::where('status', 'pending')
                ->where('created_at', '<=',now())
                ->where('expiry_date', '>=',now())
                ->count(),
            'completed' => Order::where('status', 'completed')
                ->whereDate('updated_at', now())
                ->count(),

            'expired' => Order::where('status', 'expired')->count(),

            default => Order::count(),
        };
    }
}
