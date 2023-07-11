
<?php

class Type
{
  private $conn;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function getAllTypes()
  {
    $query = "SELECT * FROM types";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getTypeById($id)
  {
    $query = "SELECT * FROM types WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function createType($name, $tax)
  {
    $query = "INSERT INTO types (name, tax) VALUES (?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $tax);
    if ($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }

  public function updateType($id, $name, $tax)
  {
    $query = "UPDATE types SET name = ?, tax = ? WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $tax);
    $stmt->bindParam(4, $id);
    if ($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }

  public function deleteType($id)
  {
    $query = "DELETE FROM types WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    if ($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }
}
