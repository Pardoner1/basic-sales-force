
<?php

class Sell
{
  private $conn;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function getAllSells()
  {
    $query = "SELECT * FROM sells";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getSellById($id)
  {
    $query = "SELECT * FROM sells WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function createSell($products, $created_by)
  {
    $query = "INSERT INTO sells (products, created_by) VALUES (?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $products);
    $stmt->bindParam(2, $created_by);
    if ($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }

  public function updateSell($id, $products, $created_by)
  {
    $query = "UPDATE sells SET products = ?, created_by = ? WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $products);
    $stmt->bindParam(2, $created_by);
    $stmt->bindParam(4, $id);
    if ($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }

  public function deleteSell($id)
  {
    $query = "DELETE FROM sells WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    if ($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }
}
