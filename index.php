<?php
// Arquivo index.php

// Inclua o arquivo que contém a lógica da API
require_once './services/routes/api.php';

// Crie uma instância da classe API e execute o método principal
$api = new API();
$api->handleRequest();
// phpinfo();


// arquivo.php

// Inclua o arquivo config.php
// require_once 'config.php';

// try {
//     $dsn = "pgsql:host=" . DBHOST . ";port=" . DBPORT . ";dbname=" . DBNAME . ";user=" . DBUSER . ";password=" . DBPASS;
//     $pdo = new PDO($dsn);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Conexão bem-sucedida com o banco de dados PostgreSQL";
// } catch (PDOException $e) {
//     echo "Erro na conexão com o banco de dados: " . $e->getMessage();
// }
