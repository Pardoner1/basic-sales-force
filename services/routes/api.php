<?php
// Arquivo api.php

// Inclua o arquivo config.php
require_once 'config.php';
require_once './services/controllers/UserController.php';

class API
{
  private $db;
  private $userController;
  private $response;

  public function __construct()
  {
    // Conecte-se ao banco de dados PostgreSQL
    $dsn = "pgsql:host=" . DBHOST . ";port=" . DBPORT . ";dbname=" . DBNAME . ";user=" . DBUSER . ";password=" . DBPASS;
    try {
      $this->db = new PDO($dsn);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo 'Database connection error: ' . $e->getMessage();
    }
  }

  public function handleRequest()
  {
    header('Content-Type: application/json');
    // Obtenha a URL amigável
    $requestUri = $_SERVER['REQUEST_URI'];
    $requestUri = strtok($requestUri, '?'); // Remova a parte da URL após o ponto de interrogação, se houver

    // Separe a URL em partes usando a barra como delimitador
    $parts = explode('/', $requestUri);

    // Remova a primeira parte da URL, que é vazia devido à barra inicial
    array_shift($parts);

    // Verifique o método da requisição
    $method = $_SERVER['REQUEST_METHOD'];

    // Roteamento de URLs
    switch ($method) {
      case 'GET':
        // Exemplo: /api/users/1
        if ($parts[0] === 'api') {
          switch ($parts[1]) {
            case 'users':
              $this->userController = new UserController($this->db);
              if (isset($parts[2])) {
                $this->response = $this->userController->getUserById($parts[2]);
                echo json_encode($this->response);
              } else {
                $this->response = $this->userController->getAllUsers();
                echo json_encode($this->response);
              }
              break;

            default:
              echo $this->notFound();
              break;
          }
        } else {
          $this->notFound();
        }
        break;
      case 'POST':
        // Exemplo: /api/users
        if ($parts[0] === 'api' && $parts[1] === 'users') {
          $this->createUser();
        } else {
          $this->notFound();
        }
        break;
      case 'PUT':
        // Exemplo: /api/users/1
        if ($parts[0] === 'api') {
          switch ($parts[1]) {
            case 'users':
              $this->userController = new UserController($this->db);
              $postData = json_decode(file_get_contents('php://input'), true);
              $this->response = $this->userController->updateUser($postData);
              echo json_decode($this->response);
              break;

            default:
              echo $this->notFound();
              break;
          }
        } else {
          echo $this->notFound();
        }
        break;
      case 'DELETE':
        // Exemplo: /api/users/1
        if ($parts[0] === 'api' && $parts[1] === 'users' && isset($parts[2])) {
          $userId = intval($parts[2]);
          $this->deleteUser($userId);
        } else {
          $this->notFound();
        }
        break;
      default:
        $this->notFound();
        break;
    }
  }

  private function notFound()
  {
    header("HTTP/1.1 404 Not Found");
    exit();
  }
}
