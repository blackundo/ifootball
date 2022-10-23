<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ProductCategory;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductComment\ProductCommentRepositoryInterface;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    private $productService;
    private $productCommentService;
    private $categoryService;
    private $brandService;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductCommentRepositoryInterface $productCommentRepository,
        CategoryRepositoryInterface $categoryRepository,
        BrandRepositoryInterface $brandRepository
    ) {
        $this->productService = $productRepository;
        $this->productCommentService = $productCommentRepository;
        $this->categoryService = $categoryRepository;
        $this->brandService = $brandRepository;
    }

    public function show($id)
    {
        //Get category
        $categories = $this->categoryService->all();
        //Get Brand
        $brands = $this->brandService->all();

        $product = $this->productService->find($id);
        $relatedProducts = $this->productService->getRelatedProducts($product, 4);
        return view('front.shop.show', compact('product', 'relatedProducts', 'categories', 'brands'));
    }

    public function postComment(Request $request)
    {
        $this->productCommentService->create($request->all());
        //        ProductComment::create($request->all());
        return redirect()->back();
    }

    public function index(Request $request)
    {
        //Get category
        $categories = $this->categoryService->all();
        //Get Brand
        $brands = $this->brandService->all();
        //Get Product
        $products = $this->productService->getProductOnIndex($request);

        return view('front.shop.index', compact('products', 'categories', 'brands'));
    }

    public function category($categoryName, Request $request)
    {
        //Get category
        $categories = $this->categoryService->all();
        //Get Brand
        $brands = $this->brandService->all();

        $products = $this->productService->getProductsByCategory($categoryName, $request);
        return view('front.shop.index', compact('products', 'categories', 'brands'));
    }
}
