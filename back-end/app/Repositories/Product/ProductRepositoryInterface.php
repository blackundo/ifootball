<?php

namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getRelatedProducts($product, $limit = 4);
    public function getFeaturedProductsByCategory(int $categoryID);
    public function getProductOnIndex($request);
    public function getProductsByCategory($categoryName, $request);
}
