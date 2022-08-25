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

    // Increase the number of products in the user's basket
    public function increase($id)
    {
        \Cart::session(auth()->user()->id)->update($id, [
            'quantity' => +1
        ]);
    }

    // Decrease the number of products in the user's basket
    public function decrease($id)
    {
        $item = \Cart::session(auth()->user()->id)->get($id);

        if ($item->quantity === 1) {
            $this->remove($id);
            return;
        }

        \Cart::session(auth()->user()->id)->update($id, [
            'quantity' => -1
        ]);
    }

    // Removing the item from the shopping cart
    public function remove($id)
    {
        \Cart::session(auth()->user()->id)->remove($id);
    }
}
