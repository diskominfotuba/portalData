<?php

namespace App\Services;

class BaseService
{
    public $model;
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        $model = $this->model->find($id);
        return $model;
    }
    public function update($model, $data)
    {
        $model->update($data);
        return $model;
    }

    public function Query()
    {
        return $this->model->query();
    }

    public function delete($id)
    {
        $model = $this->model->find($id);
        return $model->delete();
    }
}
