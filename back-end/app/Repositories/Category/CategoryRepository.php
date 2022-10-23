<?php

namespace App\Repositories\Category;

use App\Models\ProductCategory;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    public function getModel()
    {
       return ProductCategory::class;
    }



}
