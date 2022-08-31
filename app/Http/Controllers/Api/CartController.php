<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repositories\CartRepository;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        $cartContent = (new CartRepository())->content();
        $cartCount
            = (new CartRepository())->count();
        return response()->json([
            'cartContent'   => $cartContent,
            'cartCount'     => $cartCount
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        // The product's ID number should be printed on the button."add-to-cart"
        $product = Product::where('id', $request->productId)->first();

        // Une classe est dédié à s'occuper de la gestion du panier.
        $count = (new CartRepository())->add($product);
        return response()->json([
            'count' => $count
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    //
    public function count(): JsonResponse
    {
        $count = (new CartRepository())->count();

        return response()->json([
            'count' => $count
        ]);
    }

    // Increase the number of products in the user's basket
    public function increase(int $id)
    {
        (new CartRepository())->increase($id);
    }

    // Decrease the number of products in the user's basket
    public function decrease(int $id)
    {
        (new CartRepository())->decrease($id);
    }

    /**
     * Remove the specified resource from storage.
     * Removing the item from the shopping cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        $count = (new CartRepository())->remove($id);

        return response()->json([
            'count' => $count
        ]);
    }
}
