<?php

require_once __DIR__ . '/TestCase.php';

class DatabaseTest extends BaseTestCase {
    public function testConexaoComBanco() {
        $this->assertNotNull($this->pdo, "Falha na conexão com o banco de dados.");
    }
}
