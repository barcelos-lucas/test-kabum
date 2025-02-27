<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(!isset ($_SESSION['usuario_id'])) {
    header("Location: formsLogin.html");
    exit;
}


require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/services/clienteServices.php';

$pdo = conectarBanco();
$clientes = listarClientes($pdo);

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard de Clientes</title>
    <link rel="stylesheet" href="assets/css/clientes.css">
</head>
<body>
    <header class="header-clientes">
        <h1>CLIENTES</h1>
        <nav>
            <a href="dashboard.php" class="btn-dashboard">Dashboard</a>
        </nav>
    </header>

    <?php if (isset($_GET['excluido'])): ?>
    <div class="mensagem sucesso">
        Cliente excluído com sucesso!
    </div>
<?php endif; ?>


    <div class="container">
    <a href="adicionarClientes.php" class="btn-adicionar"> Adicionar Clientes</a>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>CPF</th>
                    <th>RG</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= $cliente['id'] ?></td>
                        <td><?= htmlspecialchars($cliente['nome']) ?></td>
                        <td><?= date('d/m/Y', strtotime($cliente['data_nascimento'])) ?></td>
                        <td><?= htmlspecialchars($cliente['cpf']) ?></td>
                        <td><?= htmlspecialchars($cliente['rg']) ?></td>
                        <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                        <td>
                            <a href="editarClientes.php?id=<?= $cliente['id'] ?>" class="btn editar">Editar</a> |
                            <a href="excluirClientes.php?id=<?= $cliente['id'] ?>" class="btn excluir">Excluir</a> | 
                            <a href="gerenciarEnderecos.php?id=<?= $cliente['id'] ?>" class="btn adicionar">Endereços</a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>