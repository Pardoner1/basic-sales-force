<?php
// Arquivo index.php

// Inclua o arquivo que contém a lógica da API
require_once './services/routes/api.php';

// Crie uma instância da classe API e execute o método principal
$api = new API();
$api->handleRequest();
// phpinfo();