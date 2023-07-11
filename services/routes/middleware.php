<?php

require_once './vendor/autoload.php';
require_once 'config.php';

use Firebase\JWT\JWT;

function authenticate()
{
  $headers = getallheaders();
  $authorizationHeader = $headers['Authorization'] ?? '';

  if ($authorizationHeader) {
    list($jwt) = sscanf($authorizationHeader, 'Bearer %s');

    if ($jwt) {
      try {
        $decoded = JWT::decode($jwt, SECRETKEY, ['HS256']);
        // O token é válido, continue com a execução da rota
      } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['message' => 'Token inválido']);
        exit;
      }
    }
  }

  http_response_code(401);
  echo json_encode(['message' => 'Token não fornecido']);
  exit;
}
