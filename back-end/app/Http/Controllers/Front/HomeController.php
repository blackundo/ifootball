<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Service\Blog\BlogServiceInterface;
use App\Service\Product\ProductServiceInterface;

class HomeController extends Controller
{
    private $productService;
    private $blogService;
    public function __construct(ProductServiceInterface $productService, BlogServiceInterface $blogService)
    {
        $this->productService = $productService;
        $this->blogService = $blogService;
    }

    public function index()
    {
        $featuredProducts = $this->productService->getFeaturedProducts();

        $menProducts = $featuredProducts["men"];
        $womenProducts = $featuredProducts["women"];
        $blogs = $this->blogService->getLatesBlogs(3);
        //        $blogs = Blog::orderBy('id','desc')->limit(3)->get();

        return view('front.index', compact('menProducts', 'womenProducts', 'blogs'));
    }
}
