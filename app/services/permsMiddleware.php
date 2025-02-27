<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

function verificarPermissao($cargoNecessario) {
    if (!isset($_SESSION['user_cargo']) || $_SESSION['user_cargo'] !== $cargoNecessario) {
        header("Location: ../public/acessoNegado.php");
        exit;
    }
}
?>
