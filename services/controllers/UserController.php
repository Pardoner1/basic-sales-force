<?php

require_once './services/models/User.php';

class UserController
{
  private $model;

  public function __construct($pdo)
  {
    $this->model = new User($pdo);
  }

  public function createUser($data)
  {
    return $this->model->createUser($data['name'], $data['email'], $data['password']);
  }

  public function getAllUsers()
  {
    return $this->model->getAllUsers();
  }

  public function getUserById($id)
  {
    return $this->model->getUserById($id);
  }

  public function updateUser($data)
  {
    return $this->model->updateUser($data['id'], $data['name'], $data['email'], $data['password']);
  }

  public function deleteUser($id)
  {
    return $this->model->deleteUser($id);
  }
}
