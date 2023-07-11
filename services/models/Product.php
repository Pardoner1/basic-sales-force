
<?php

class Product
{
  private $conn;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function getAllProducts()
  {
    $query = "SELECT * FROM products";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getProductById($id)
  {
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function createProduct($name, $price, $type_id)
  {
    $query = "INSERT INTO products (name, price, type_id) VALUES (?, ?, ?)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $price);
    $stmt->bindParam(3, $type_id);
    if ($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }

  public function updateProduct($id, $name, $price, $type_id)
  {
    $query = "UPDATE products SET name = ?, price = ?, type_id = ? WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $price);
    $stmt->bindParam(3, $type_id);
    $stmt->bindParam(4, $id);
    if ($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }

  public function deleteProduct($id)
  {
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $id);
    if ($stmt->execute()) {
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
  }
}
