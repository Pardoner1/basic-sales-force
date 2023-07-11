<?php

require_once './services/models/Product.php';

class ProductController
{
  private $model;

  public function __construct($pdo)
  {
    $this->model = new Product($pdo);
  }

  public function createProduct($data)
  {
    return $this->model->createProduct($data['name'], $data['price'], $data['type_id']);
  }

  public function getAllProducts()
  {
    return $this->model->getAllProducts();
  }

  public function getProductById($id)
  {
    return $this->model->getProductById($id);
  }

  public function updateProduct($data)
  {
    return $this->model->updateProduct($data['id'], $data['name'], $data['price'], $data['type_id']);
  }

  public function deleteProduct($id)
  {
    return $this->model->deleteProduct($id);
  }
}
