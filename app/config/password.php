<?php
// Senha a ser criptografada
$senha = 'lucas123';

// Criação do hash usando bcrypt
$senha_hash = password_hash($senha, PASSWORD_BCRYPT);

// Exibindo o hash gerado
echo "Senha com hash: " . $senha_hash;
?>
