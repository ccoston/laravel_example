<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::paginate()->withQueryString();

        return Inertia::render('Products', [
            'products' => $products
        ]);
    }

    public function show(int $id)
    {
        $product = Product::findOrFail($id)
            ->append('lastSevenDaysCount');

        return Inertia::render('ProductDetail', [
            'product' => $product,
        ]);
    }
}
