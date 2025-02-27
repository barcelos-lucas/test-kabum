<?php

require_once __DIR__ . '/TestCase.php';
require_once __DIR__ . '/../app/services/userServices.php';

class AuthTest extends BaseTestCase {
    public function testLoginCorreto() {
        $email = "teste@exemplo.com";
        $senha = "senha123"; 

        $usuario = loginUsuario($this->pdo, $email, $senha);

        $this->assertIsArray($usuario, "Login falhou, usuário não encontrado.");
        $this->assertEquals($email, $usuario['email'], "Email do usuário incorreto.");
    }

    public function testLoginSenhaIncorreta() {
        $email = "teste@exemplo.com";
        $senha = "senhaErrada";

        $usuario = loginUsuario($this->pdo, $email, $senha);

        $this->assertFalse($usuario, "Login deveria falhar com senha incorreta.");
    }
}
