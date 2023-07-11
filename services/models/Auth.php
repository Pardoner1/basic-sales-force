<?php

class Auth
{
  private $conn;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function findByEmail($email)
  {
    $query = $this->conn->prepare('SELECT * FROM users WHERE email = :email');
    $query->bindParam(':email', $email);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
  }
}
