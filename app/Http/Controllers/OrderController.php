<?php

namespace App\Http\Controllers;

use App\Repositories\CartRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Saving the order for the authenticated user in the database
    public function __invoke()
    {
        $order = auth()->user()->orders()->create([
            'order_number' => uniqid()
        ]);

        (new CartRepository())->content()->each(function($product) use($order) {
            $order->products()->attach($product->id, [
                'total_price' => $product->price * $product->quantity,
                'total_quantity' => $product->quantity,
            ]);
        });
        (new CartRepository())->clear();
    }
}
