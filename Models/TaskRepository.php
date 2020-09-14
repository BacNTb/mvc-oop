<?php

namespace Mvc\Models;

use Mvc\Models\TaskResourceModel;

class TaskRepository
{
    private $TaskResourceModel;

    public function __construct() {
        $this->TaskResourceModel = new TaskResourceModel();
    }

    public function add($model) {
        
        return $this->TaskResourceModel->save($model);
    }

    public function update($model)  {
        
        return $this->TaskResourceModel->save($model);
    }

    public function delete($model) {
        return $this->TaskResourceModel->delete($model);
    }

    public function showTask($id) {
        return $this->TaskResourceModel->showTask($id);
    }

    public function getAll() {
        return $this->TaskResourceModel->getAll();
    }
}