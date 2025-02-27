<?php

use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

class BaseTestCase extends TestCase {
    protected $pdo;

    protected function setUp(): void {
        // Carregar o .env
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        // Conecta no banco de testes
        $this->pdo = new PDO(
            "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}
