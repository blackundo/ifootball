<?php

namespace App\Service\Category;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Service\BaseService;

class CategoryService extends BaseService implements CategoryServiceInterface
{
    public $repository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }



}
