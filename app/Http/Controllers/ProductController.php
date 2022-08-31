<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Only pick the 20 active products, then arrange them in random order.
    public function index()
    {
        $products = Product::inRandomOrder()
            ->whereActive(true)
            ->take(20)
            ->get();

        return view('products.index', compact('products'));
    }
}
