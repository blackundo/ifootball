<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $productService;

    public function __construct(ProductServiceInterface $productService) {
        $this->productService = $productService;
    }

    public function show($id) {
        $products = $this->productService->find($id); 

        return view('front.shop.show', compact('products'));
    }
}
