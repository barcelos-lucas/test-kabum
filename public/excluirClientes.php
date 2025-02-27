<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: formsLogin.html");
    exit;
}

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/services/clienteServices.php';

$pdo = conectarBanco();

// ID via GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID do cliente não especificado.");
}

$cliente_id = $_GET['id'];

// valida o cliente antes de excluir (para exibir a mensagem)
$cliente = buscarClientePorId($pdo, $cliente_id);
if (!$cliente) {
    die("Cliente não encontrado.");
}

// exclui o cliente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if (excluirClientes($pdo, $cliente_id)) {
            header("Location: clientes.php?excluido=1");
            exit;
        }
    } catch (Exception $e) {
        die("Erro ao excluir cliente: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Excluir Cliente</title>
    <link rel="stylesheet" href="assets/css/excluirClientes.css">
</head>
<body>
    <header>
        <h1>Excluir Cliente</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="clientes.php">Gerenciar Clientes</a>
            <a href="logout.php">Sair</a>
        </nav>
    </header>

    <div class="container">
        <h2>Tem certeza que deseja excluir o cliente?</h2>
        <p><strong>Nome:</strong> <?= htmlspecialchars($cliente['nome']) ?></p>
        <p><strong>CPF:</strong> <?= htmlspecialchars($cliente['cpf']) ?></p>
        <p><strong>RG:</strong> <?= htmlspecialchars($cliente['rg']) ?></p>
        <p><strong>Telefone:</strong> <?= htmlspecialchars($cliente['telefone']) ?></p>

        <form method="POST">
            <button type="submit" class="btn excluir">Sim, excluir</button>
            <a href="clientes.php" class="btn voltar">Cancelar</a>
        </form>
    </div>
</body>
</html>
