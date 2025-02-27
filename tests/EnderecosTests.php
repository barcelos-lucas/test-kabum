<?php

require_once __DIR__ . '/TestCase.php';
require_once __DIR__ . '/../app/services/enderecoServices.php';

class EnderecosTest extends BaseTestCase {
    public function testCriarEndereco() {
        $cliente_id = 1; 
        $endereco = [
            "rua" => "Rua Teste",
            "numero" => "123",
            "complemento" => "Apto 101",
            "bairro" => "Centro",
            "cidade" => "Belo Horizonte",
            "estado" => "MG",
            "cep" => "30130000"
        ];

        $resultado = adicionarEndereco(
            $this->pdo,
            $cliente_id,
            $endereco["rua"],
            $endereco["numero"],
            $endereco["complemento"],
            $endereco["bairro"],
            $endereco["cidade"],
            $endereco["estado"],
            $endereco["cep"]
        );

        $this->assertTrue($resultado, "Falha ao cadastrar endereço.");
    }
}
