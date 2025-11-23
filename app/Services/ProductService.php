<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function getSortedProducts($category_id, $search = '')
    {
        return Product::with('category')
            ->when($category_id != 0, function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('name', 'asc')
            ->paginate(8);
    }

    public function getSortedSales($date, $type, $category_id, $search = '')
    {
        return Product::with([
            'category',
            'serials.orders' => function ($query) use ($type, $date) {
                $query->where('status', 'completed')
                    ->whereBetween('orders.updated_at', [$date, now()]);

                if ($type !== 'all') {
                    $query->where('type', $type);
                }
            }
        ])
            ->whereHas('serials.orders', function ($query) use ($type, $date) {
                $query->where('status', 'completed')
                    ->whereBetween('orders.updated_at', [$date, now()]);

                if ($type !== 'all') {
                    $query->where('type', $type);
                }
            })
            ->when($category_id != 0, function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('products.created_at', 'asc')
            ->paginate(8);
    }

    public function getTopSellingProduct()
    {
        // Load products with serials and their related completed orders
        $products = Product::with([
            'serials' => function ($q) {
                $q->where('status', 'sold');
            },
            'serials.orders' => function ($query) {
                $query->where('status', 'completed');
            },
            'category'
        ])->get();

        // Calculate total sales per product (based on completed orders)
        $products = $products->map(function ($product) {
            // Count how many serials of this product are tied to completed orders
            $soldCount = $product->serials->reduce(function ($carry, $serial) {
                return $carry + $serial->orders->count();
            }, 0);

            $product->sold_count = $soldCount;
            return $product;
        });

        // Get the highest sold count
        $maxSold = $products->max('sold_count');

        // Compute and rank products by sales score
        return $products->map(function ($product) use ($maxSold) {
            $product->sales_score = $maxSold > 0
                ? round(($product->sold_count / $maxSold) * 100, 2)
                : 0;
            return $product;
        })
            ->filter(fn($p) => $p->sales_score > 0)
            ->sortByDesc('sales_score')
            ->values();
    }

    public function getProductWithStock($category_id = 0, $search = '')
    {
        return Product::with(['serials' => function ($q) {
            $q->where('status', 'available');
        }, 'category'])
            ->when($category_id != 0, function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(10);
    }
}
