<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: formsLogin.html");
    exit;
}

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/services/clienteServices.php';

$pdo = conectarBanco();
$mensagem = "";
$sucessoEdicao = false;

// Verifica se o ID do cliente foi passado na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID do cliente não especificado.");
}

$cliente_id = $_GET['id'];
$cliente = buscarClientePorId($pdo, $cliente_id);

if (!$cliente) {
    die("Cliente não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $data_nascimento = trim($_POST["data_nascimento"]);
    $cpf = trim($_POST["cpf"]);
    $rg = trim($_POST["rg"]);
    $telefone = trim($_POST["telefone"]);

    try {
        if (atualizarCliente($pdo, $cliente_id, $nome, $data_nascimento, $cpf, $rg, $telefone)) {
            $mensagem = "Cliente atualizado com sucesso!";
            $sucessoEdicao = true;
            $cliente = buscarClientePorId($pdo, $cliente_id); 
        }
    } catch (Exception $e) {
        $mensagem = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="assets/css/editarClientes.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mask-plugin/1.14.16/jquery.mask.min.js"></script>
    <script src="assets/js/formsClientes.js"></script>
    <script src="assets/js/buscarCep.js"></script>
    <script src="assets/js/formataCampos.js" defer></script>
</head>
<body>
    <header class="header-clientes">
        <h1>Editar Cliente</h1>
        <nav>
            <a href="dashboard.php" class="btn-editar">Dashboard</a>
            <a href="clientes.php" class="btn-editar">Gerenciar Clientes</a>
            <a href="logout.php" class="btn-editar">Sair</a>
        </nav>
    </header>

    <div class="container">
        <?php if ($sucessoEdicao): ?>
            <div class="mensagem sucesso">
                <p><?= htmlspecialchars($mensagem) ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($mensagem) && !$sucessoEdicao): ?>
            <div class="mensagem erro">
                <p><?= htmlspecialchars($mensagem) ?></p>
            </div>
        <?php endif; ?>

        <form method="POST">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required>

            <label>Data de Nascimento:</label>
            <input type="date" name="data_nascimento" value="<?= htmlspecialchars($cliente['data_nascimento']) ?>" required>

            <label>CPF:</label>
            <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($cliente['cpf']) ?>" required>

            <label>RG:</label>
            <input type="text" id="rg" name="rg" value="<?= htmlspecialchars($cliente['rg']) ?>" required>

            <label>Telefone:</label>
            <input type="text" id="telefone" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" required>
            
            <div class="botoes">
                <a href="clientes.php" class="btn-cancelar">Cancelar</a>
                <button type="submit" class="btn-atualizar">Atualizar</button>
            </div>
        </form>
    </div>
</body>
</html>
