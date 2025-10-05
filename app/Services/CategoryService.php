<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getAllCategory()
    {
        return Category::orderBy('name')->get();
    }

    public function getCategory($search)
    {
        return Category::with('products')
        ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
        ->orderBy('name')
        ->paginate(10);
    }
}
