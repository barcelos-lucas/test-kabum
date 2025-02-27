<?php

require_once __DIR__ . '/TestCase.php';
require_once __DIR__ . '/../app/services/clienteServices.php';

class ClientesTest extends BaseTestCase {
    public function testCriarCliente() {
        $dadosCliente = [
            "nome" => "Cliente Teste",
            "data_nascimento" => "1990-05-15",
            "cpf" => "12345678901",
            "rg" => "MG-1234567",
            "telefone" => "(31) 98765-4321"
        ];

        $resultado = adicionarClientes(
            $this->pdo,
            $dadosCliente["nome"],
            $dadosCliente["data_nascimento"],
            $dadosCliente["cpf"],
            $dadosCliente["rg"],
            $dadosCliente["telefone"],
            []
        );

        $this->assertTrue($resultado, "Falha ao cadastrar cliente.");
    }
}
