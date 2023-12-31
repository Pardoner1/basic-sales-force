<?php


require_once './vendor/autoload.php';
require_once './services/routes/config.php'

use Firebase\JWT\JWT;

require_once './services/models/Auth.php';

class AuthController
{
  private $auth;

  public function __construct($pdo)
  {
    $this->auth = new Auth($pdo);
  }

  public function login()
  {
    // Obtenha as credenciais do usuário a partir da requisição
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Valide as credenciais no banco de dados
    $user = $this->auth->findByEmail($email);
    if ($user && password_verify($password, $user['password'])) {
      // Crie um token JWT
      $token = [
        'user_id' => $user['id'],
        'email' => $user['email'],
        'exp' => time() + 3600 // expiração em 1 hora
      ];
      $jwt = JWT::encode($token, SECRETKEY);

      // Retorne o token como resposta
      echo json_encode(['token' => $jwt]);
    } else {
      // Retorne uma resposta de erro
      http_response_code(401);
      echo json_encode(['message' => 'Invalid Credentials']);
    }
  }

  // Outros métodos para manipular usuários (criar, atualizar, excluir, etc.)
}
