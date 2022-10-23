<?php

namespace App\Providers;

use App\Repositories\Blog\BlogRepository;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Brand\BrandRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderDetail\OrderDetailRepository;
use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductComment\ProductCommentRepository;
use App\Repositories\ProductComment\ProductCommentRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;


use App\Service\Blog\BlogService;
use App\Service\Blog\BlogServiceInterface;
use App\Service\Brand\BrandService;
use App\Service\Brand\BrandServiceInterface;
use App\Service\Category\CategoryService;
use App\Service\Category\CategoryServiceInterface;
use App\Service\Order\OrderService;
use App\Service\Order\OrderServiceInterface;
use App\Service\OrderDetail\OrderDetailService;
use App\Service\OrderDetail\OrderDetailServiceInterface;
use App\Service\Product\ProductService;
use App\Service\Product\ProductServiceInterface;
use App\Service\ProductComment\ProductCommentService;
use App\Service\ProductComment\ProductCommentServiceInterface;
use App\Service\User\UserService;
use App\Service\User\UserServiceInterface;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Product
        $this->app->singleton(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
        $this->app->singleton(
            ProductServiceInterface::class,
            ProductService::class
        );
        //Product Comment
        $this->app->singleton(
            ProductCommentRepositoryInterface::class,
            ProductCommentRepository::class
        );
        $this->app->singleton(
            ProductCommentServiceInterface::class,
            ProductCommentService::class
        );
        //Blog
        $this->app->singleton(
            BlogRepositoryInterface::class,
            BlogRepository::class
        );
        $this->app->singleton(
            BlogServiceInterface::class,
            BlogService::class
        );
        //Category
        $this->app->singleton(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
        $this->app->singleton(
            CategoryServiceInterface::class,
            CategoryService::class
        );
        //Brand
        $this->app->singleton(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );
        $this->app->singleton(
            BrandServiceInterface::class,
            BrandService::class
        );
        //Order
        $this->app->singleton(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );
        $this->app->singleton(
            OrderServiceInterface::class,
            OrderService::class
        );
        //OrderDetail
        $this->app->singleton(
            OrderDetailRepositoryInterface::class,
            OrderDetailRepository::class
        );
        $this->app->singleton(
            OrderDetailServiceInterface::class,
            OrderDetailService::class
        );
        //User
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->singleton(
            UserServiceInterface::class,
            UserService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
