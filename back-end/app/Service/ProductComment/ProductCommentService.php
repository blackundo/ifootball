<?php

namespace App\Service\ProductComment;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductComment\ProductCommentRepositoryInterface;
use App\Service\BaseService;

class ProductCommentService extends BaseService implements ProductRepositoryInterface
{
    public $repository;

    public function __construct(ProductCommentRepositoryInterface $productCommentRepository)
    {
        $this->repository = $productCommentRepository;
    }
}
