<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Place the products in a random order and only choose 20 active products.
    public function index()
    {
        $products = Product::inRandomOrder()
            ->whereActive(true)
            ->take(20)
            ->get();

        return view('products.index', compact('products'));
    }
}
