<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Negado</title>
    <link rel="stylesheet" href="assets/css/acessoNegado.css"> 
</head>
<body>
    <div class="container">
        <h1>ACESSO NEGADO</h1>
        <p> VOCÊ NÃO TEM PERMISSÃO PARA EXCLUIR </p>
        <a href="dashboard.php" class="btn btn-primary">Voltar</a>
    </div>
</body>
</html>
