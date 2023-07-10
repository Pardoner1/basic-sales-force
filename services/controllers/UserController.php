<?php

require_once './services/models/User.php';

class UserController
{
  private $model;

  public function __construct($pdo)
  {
    $this->model = new User($pdo);
  }

  public function createUser($name, $email, $password)
  {
    return $this->model->createUser($name, $email, $password);
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




function getUsers($pdo)
{
  $sql = 'SELECT * FROM users';

  try {
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($result);
  } catch (PDOException $e) {
    echo 'Erro ao recuperar registros: ' . $e->getMessage();
  }
}
