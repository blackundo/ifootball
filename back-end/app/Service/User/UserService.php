<?php

namespace App\Service\User;

use App\Repositories\User\UserRepositoryInterface;
use App\Service\BaseService;

class UserService extends BaseService implements UserServiceInterface
{
    public $repository;
    public function __construct(UserRepositoryInterface $UserRepository)
    {
        $this->repository = $UserRepository;
    }
}
