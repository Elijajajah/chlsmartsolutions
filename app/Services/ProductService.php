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
        $products = Product::with('inventory', 'orderProducts.order', 'category')->get();

        return $products->filter(function ($product) {
            $inventory = $product->inventory;

            $soldQuantity = $product->orderProducts
                ->where('order.status', 'completed')
                ->sum('quantity');

            return $soldQuantity >= ($inventory->stock_max_limit / 2);
        })->sortByDesc(function ($product) {
            return $product->orderProducts
                ->where('order.status', 'completed')
                ->sum('quantity');
        })->values();
    }

    public function getProductWithStock($category_id = 0, $search = '')
    {
        return Product::with(['inventory', 'orderProducts.order', 'category'])
            ->when($category_id != 0, function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->through(function ($product) {
                $inventory = $product->inventory;

                $pendingQuantity = $product->orderProducts
                    ->where('order.status', 'pending')
                    ->sum('quantity');

                $adjustedStock = $inventory ? ($inventory->stock + $pendingQuantity) : 0;

                $product->adjusted_stock = $adjustedStock;

                return $product;
            });
    }



}
