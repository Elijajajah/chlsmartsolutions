<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function countStaff($role)
    {
        return match ($role) {
            'staff' => User::whereNotIn('role', ['customer', 'owner'])->where('status', 'active')->count(),
            default => User::where('role', $role)->where('status', 'active')->count(),
        };
    }

    public function getStaffs($search, $role, $status)
    {
        return User::whereNotIn('role', ['customer', 'owner'])
            ->when($search, function ($query) use ($search) {
                $query->where('fullname', 'like', '%' . $search . '%');
            })
            ->when($role != 'all', fn($query) => $query->where('role', $role))
            ->when($status != 'all', fn($query) => $query->where('status', $status))
            ->paginate(10);
    }
}
