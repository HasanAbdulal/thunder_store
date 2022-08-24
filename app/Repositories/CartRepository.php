<?php

namespace App\Repositories;


use App\Models\Product;

class CartRepository
{
    // Add to basket
    public function add(Product $product)
    {
        \Cart::session(auth()->user()->id)->add(array(
            'id'                => $product->id,
            'name'              => $product->name,
            'price'             => $product->price,
            'quantity'          => 1,
            'associatedModel'   => $product
        ));

        return $this->count();
    }

    // Send the package's contents along with it.
    public function content()
    {
        return \Cart::session(auth()->user()->id)->getContent();
    }

    // Make a count of the items in your cart.
    public function count()
    {
        return $this->content()->sum('quantity');
    }
}
