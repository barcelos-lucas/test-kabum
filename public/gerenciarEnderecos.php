<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: formsLogin.html");
    exit;
}

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/services/enderecoServices.php';

$pdo = conectarBanco();

// ID via GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID do cliente não encontrado.");
}

$cliente_id = $_GET['id'];
$enderecos = listarEnderecosPorCliente($pdo, $cliente_id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Endereços</title>
    <link rel="stylesheet" href="assets/css/gerenciarEnderecos.css">
</head>
<body>
    <header>
        <h1>Gerenciar Endereços</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="clientes.php">Voltar para Clientes</a>
            <a href="logout.php">Sair</a>
        </nav>
    </header>
    

    <div class="container">
    <a href="adicionarEnderecos.php?id=<?= $cliente_id ?>" class="btn adicionar">Novo Endereço</a>
        <h2>Endereços do Cliente</h2>
        <table>
            <thead>
                <tr>
                    <th>Rua</th>
                    <th>Número</th>
                    <th>Complemento</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>CEP</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($enderecos as $endereco): ?>
                    <tr>
                        <td><?= htmlspecialchars($endereco['rua']) ?></td>
                        <td><?= htmlspecialchars($endereco['numero']) ?></td>
                        <td><?= htmlspecialchars($endereco['complemento']) ?></td>
                        <td><?= htmlspecialchars($endereco['bairro']) ?></td>
                        <td><?= htmlspecialchars($endereco['cidade']) ?></td>
                        <td><?= htmlspecialchars($endereco['estado']) ?></td>
                        <td><?= htmlspecialchars($endereco['cep']) ?></td>
                        <td>
                            <a href="editarEnderecos.php?id=<?= $endereco['id'] ?>" class="btn editar">Editar</a>
                            <a href="excluirEnderecos.php?id=<?= $endereco['id'] ?>" class="btn excluir">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

   
    </div>
</body>
</html>
