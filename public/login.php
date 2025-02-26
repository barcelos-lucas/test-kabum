<?php

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/services/userServices.php';

session_start();

$pdo = conectarBanco();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $resultado = loginUsuario($pdo, $email, $senha);

    if ($resultado === true) {
        header("Location: dashboard.php"); 
        exit;
    } else {
      header("Location: formsLogin.html?error=" .urlencode("Email ou senha incorretos"));	
        echo "<p style='color: red;'>$resultado</p>";
    }
}
?>


