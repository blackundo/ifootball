<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Service\BaseService;
use App\Service\Order\OrderServiceInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{

    public function getModel()
    {
       return Order::class;
    }
}
