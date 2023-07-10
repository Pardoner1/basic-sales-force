
<?php

class User
{
  private $conn;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function getAllUsers()
  {
    $query = "SELECT * FROM users";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getUserById($id)
  {
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function createUser($name, $email, $password)
  {
    $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, password_hash($password, PASSWORD_DEFAULT));
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  public function updateUser($id, $name, $email, $password)
  {
    $query = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, password_hash($password, PASSWORD_DEFAULT));
    $stmt->bindParam(4, $id);
    if ($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }

  public function deleteUser($id)
  {
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
}
