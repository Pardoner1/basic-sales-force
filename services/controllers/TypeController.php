<?php

require_once './services/models/Type.php';

class TypeController
{
  private $model;

  public function __construct($pdo)
  {
    $this->model = new Type($pdo);
  }

  public function createType($data)
  {
    return $this->model->createType($data['name'], $data['tax']);
  }

  public function getAllTypes()
  {
    return $this->model->getAllTypes();
  }

  public function getTypeById($id)
  {
    return $this->model->getTypeById($id);
  }

  public function updateType($data)
  {
    return $this->model->updateType($data['id'], $data['name'], $data['tax']);
  }

  public function deleteType($id)
  {
    return $this->model->deleteType($id);
  }
}
