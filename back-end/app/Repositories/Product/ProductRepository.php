<?php

namespace App\Repositories\Product;

use App\Repositories\BaseRepositories;

class ProductRepository extends BaseRepositories implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }
}
