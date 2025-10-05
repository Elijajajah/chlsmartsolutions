<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getAvailableTechnician()
    {
        return User::with('technicianRole')
            ->where('role', 'technician')
            ->where('status', 'active')
            ->with(['tasks' => function ($query) {
                $query->whereDate('created_at', '<=', now())
                    ->whereDate('expiry_date', '>=', now())
                    ->whereNotIn('status', ['missed', 'completed']);
            }])
            ->get();
    }

    public function countStaff($role)
    {
        return match ($role) {
            'staff' => User::whereNotIn('role', ['customer', 'admin'])->where('status', 'active')->count(),
            default => User::where('role', $role)->where('status', 'active')->count(),
        };
    }

    public function getStaffs($search, $role, $status)
    {
        return User::whereNotIn('role', ['customer', 'admin'])
            ->when($search, function ($query) use ($search) {
                $query->where('fullname', 'like', '%' . $search . '%');
            })
            ->when($role != 'all', fn ($query) => $query->where('role', $role))
            ->when($status != 'all', fn ($query) => $query->where('status', $status))
            ->paginate(10);
    }
}
