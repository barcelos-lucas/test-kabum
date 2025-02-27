<?php

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/services/userServices.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pdo = conectarBanco();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $usuario = loginUsuario($pdo, $email, $senha);

    if ($usuario !== false) {
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_name'] = $usuario['nome_usuario'];
        $_SESSION['user_email'] = $usuario['email'];
        $_SESSION['user_cargo'] = $usuario['cargo'];

        header("Location: dashboard.php");
        exit;
    } else {
        header("Location: formsLogin.html?error=" . urlencode("Email ou senha incorretos"));
        exit;
    }
}
?>
