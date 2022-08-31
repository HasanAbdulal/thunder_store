<?php

namespace App\Repositories;


use App\Models\Product;
use Illuminate\Support\Collection;

class CartRepository
{
    // https://github.com/darryldecode/laravelshoppingcart
    // Add to basket
    public function add(Product $product): int
    {
        \Cart::session(auth()->user()->id)->add(array(
            'id'                => $product->id,
            'name'              => $product->name,
            'price'             => $product->price,
            'quantity'          => 1,
            'attributes'        => [],
            'associatedModel'   => $product
        ));

        return $this->count();
    }

    // Send the package's contents along with it. content global
    public function content(): Collection
    {
        return \Cart::session(auth()->user()->id)->getContent();
    }

    // Make a count of the items in your cart.
    public function count(): int
    {
        return $this->content()->sum('quantity');
    }

    // according to the payment Intent method, which renders the whole cost at euro cent
    public function total(): int
    {
        return \Cart::session(auth()->user()->id)->getTotal();
    }

    //
    public function jsonOrderItems(): string
    {
        return $this->content()->map(function ($item) {
            return [
                'name'      => $item->name,
                'quantity'  => $item->quantity,
                'price'     => $item->price
            ];
        })->toJson();
    }

    // Increase the number of products in the user's basket
    public function increase(int $id): void
    {
        \Cart::session(auth()->user()->id)->update($id, [
            'quantity' => +1
        ]);
    }

    // Decrease the number of products in the user's basket
    public function decrease(int $id)
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
    public function remove(string $id): int
    {
        \Cart::session(auth()->user()->id)->remove($id);

        return $this->count();
    }

    // After checking out, remove all items from the basket.
    public function clear()
    {
        \Cart::session(auth()->user()->id)->clear();
    }
}
