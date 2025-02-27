<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: formsLogin.html");
    exit;
}

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/services/enderecoServices.php';

$pdo = conectarBanco();
$endereco_id = $_GET['id'] ?? null;
$endereco = buscarEnderecoPorId($pdo, $endereco_id);

if (!$endereco) {
    die("Endereço não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        excluirEnderecos($pdo, $endereco_id);
        header("Location: gerenciarEnderecos.php?id=" . $endereco['cliente_id'] . "&excluido=1");
        exit;
    } catch (Exception $e) {
        die("Erro ao excluir endereço: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Excluir Endereço</title>
    <link rel="stylesheet" href="assets/css/excluirEnderecos.css">
</head>
<body>
    <header class="header-excluir-enderecos">
        <h1>Excluir Endereço</h1>
    </header>

    <div class="container">
        <h2>Tem certeza que deseja excluir o endereço?</h2>
        <p><strong>Rua:</strong> <?= htmlspecialchars($endereco['rua']) ?></p>
        <p><strong>Bairro:</strong> <?= htmlspecialchars($endereco['bairro']) ?></p>
        <p><strong>Cidade:</strong> <?= htmlspecialchars($endereco['cidade']) ?></p>
        <p><strong>CEP:</strong> <?= htmlspecialchars($endereco['cep']) ?></p>

            <form method="POST">
                <a href="clientes.php" class="btn voltar">Cancelar</a>
                <button type="submit" class="btn excluir">Excluir</button>
            </form>
    </div>
</body>
</html>
