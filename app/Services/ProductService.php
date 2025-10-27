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
            'orderProducts' => function ($query) use ($type) {
                $query->whereHas('order', function ($q) use ($type) {
                    $q->where('status', 'completed');

                    if ($type !== 'all') {
                        $q->where('type', $type);
                    }
                });
            },
            'orderProducts.order'
        ])
            ->whereHas('orderProducts.order', function ($query) use ($type, $date) {
                $query->where('status', 'completed')
                    ->whereBetween('updated_at', [$date, now()]);

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
            ->orderBy('created_at', 'asc')
            ->paginate(8);
    }

    public function getTopSellingProduct()
    {
        $products = Product::with(['serials', 'orderProducts.order', 'category'])->get();

        // Get highest sales count
        $maxSold = $products->map(function ($product) {
            return $product->orderProducts
                ->where('order.status', 'completed')
                ->sum('quantity');
        })->max();

        // Compute and rank
        return $products->map(function ($product) use ($maxSold) {
            $soldQuantity = $product->orderProducts
                ->where('order.status', 'completed')
                ->sum('quantity');

            $product->sales_score = $maxSold > 0
                ? round(($soldQuantity / $maxSold) * 100, 2)
                : 0;

            return $product;
        })
            ->filter(fn($p) => $p->sales_score > 0)
            ->sortByDesc('sales_score')
            ->values();
    }


    public function getProductWithStock($category_id = 0, $search = '')
    {
        return Product::with(['serials', 'orderProducts.order', 'category'])
            ->when($category_id != 0, function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->through(function ($product) {
                $availableStock = $product->availableReservedCount();

                $product->adjusted_stock = $availableStock;

                return $product;
            });
    }
}
