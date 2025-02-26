<?php

require_once __DIR__ . '/../../vendor/autoload.php';  

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../'); // Carregar .env da raiz
$dotenv->load();

function conectarBanco() {
    try {
        // Pegando valores do arquivo .env corretamente
        $pdo = new PDO(
            'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS']
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('Erro na conexão: ' . $e->getMessage());
    }
}
