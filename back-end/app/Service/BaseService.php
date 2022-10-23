<?php

namespace App\Service;

class BaseService implements ServiceInterface
{
    public $repository;


    public function all()
    {
        return $this->repository->all();
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(array $data, $id)
    {
        $obj = $this->repository->find($id);
        return $obj->update($data);
    }

    public function delete($id)
    {
        $obj = $this->repository->find($id);
        return $obj->delete();
    }
}
