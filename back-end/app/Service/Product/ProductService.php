<?php

namespace App\Service\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Service\BaseService;

class ProductService extends BaseService implements ProductServiceInterface
{
    public $repository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
    }

    public function find($id)
    {
        $product =  $this->repository->find($id);

        $avgRating = 0;
        $sumRating = array_sum(array_column($product->productComments->toArray(), 'rating'));
        $countRating = count($product->productComments);
        if ($countRating != 0) {
            $avgRating = $sumRating / $countRating;
        }

        $product->avgRating = $avgRating;
        return $product;
    }

    public function getRelatedProducts($product, $limit = 4)
    {
        $this->repository->getRelatedProducts($product, $limit);
    }
    public function getFeaturedProducts()
    {
        return [
            "men" => $this->repository->getFeaturedProductsByCategory(1),
            "women" => $this->repository->getFeaturedProductsByCategory(2)
        ];
    }
    public function getProductOnIndex($request)
    {
        return $this->repository->getProductOnIndex();
    }
    public function getProductsByCategory($categoryName, $request)
    {
        return $this->repository->getFeaturedProductsByCategory($categoryName, $request);
    }
}
