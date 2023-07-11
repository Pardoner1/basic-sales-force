<?php

require_once './services/models/Sell.php';

class SellController
{
  private $model;

  public function __construct($pdo)
  {
    $this->model = new Sell($pdo);
  }

  public function createSell($data)
  {
    return $this->model->createSell($data['products'], $data['created_by']);
  }

  public function getAllSells()
  {
    return $this->model->getAllSells();
  }

  public function getSellById($id)
  {
    return $this->model->getSellById($id);
  }

  public function updateSell($data)
  {
    return $this->model->updateSell($data['id'], $data['products'], $data['created_by']);
  }

  public function deleteSell($id)
  {
    return $this->model->deleteSell($id);
  }
}
