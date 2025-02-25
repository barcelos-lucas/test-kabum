<?php
// Inclui o autoload do Composer
require_once __DIR__ . '/../vendor/autoload.php'; // Atualize o caminho para o autoload.php

// Carrega as variáveis do arquivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../'); // Caminho da raiz do projeto
$dotenv->load();

// Teste de conexão com o banco de dados
try {
    $pdo = new PDO(
        'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS']
    );
    echo "A conexão deu bom!";
} catch (PDOException $e) {
    echo "Deu ruim: " . $e->getMessage();
}
