<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Service\Product\ProductServiceInterface;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    private $productService;
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function add($id)
    {
        $product = $this->productService->find($id);
        Cart::add([
            'id' => $id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->discount ?? $product->price,
            'weight' => $product->weight ?? 0,
            'options' => [
                'images' => $product->productImages,
            ]
        ]);

        return back();
    }

    public function index()
    {
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();
        return view('front.shop.cart', compact('carts', 'total', 'subtotal'));
    }

    public function delete($rowId)
    {
        Cart::remove($rowId);
        return back();
    }
    public function update(Request $request)
    {
        if ($request->ajax()) {
            $response['cart'] =  Cart::update($request->rowId, $request->qty);
            $response['count'] = Cart::count();
            $response['total'] = Cart::total();
            $response['subtotal'] = Cart::subtotal();
            return $response;
        }
    }
    public function destroy()
    {
        Cart::destroy();
    }
}
