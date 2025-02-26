<?php

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/services/userServices.php';

$nome_usuario = 'usuario_teste5';
$email = 'teste5@exemplo.com';
$senha = 'senha123';
$cargo = 'admin';  
$status = 'ativo';  

$pdo = conectarBanco();

if (criarUsuario($pdo, $nome_usuario, $email, $senha, $cargo, $status)) {
    echo "Usuário inserido com sucesso!";
} else {
    echo "Usuário já existe!";
}

?>
