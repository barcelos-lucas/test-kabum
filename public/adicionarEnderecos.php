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
    die("ID do cliente não especificado.");
}

$cliente_id = $_GET['id'];
$mensagem = "";

// forms de adição de endereços
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rua = trim($_POST["rua"]);
    $numero = trim($_POST["numero"]);
    $complemento = trim($_POST["complemento"]);
    $bairro = trim($_POST["bairro"]);
    $cidade = trim($_POST["cidade"]);
    $estado = trim($_POST["estado"]);
    $cep = trim($_POST["cep"]);

    try {
        if (adicionarEnderecos($pdo, $cliente_id, $rua, $numero, $complemento, $bairro, $cidade, $estado, $cep)) {
            $mensagem = "Endereço registrado";
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
    <title>Adicionar Endereço</title>
    <link rel="stylesheet" href="assets/css/adicionarEnderecos.css">
    <script src="assets/js/buscarCep.js"></script>
</head>
<body>
    <header>
        <h1>Adicionar Endereço</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="gerenciarEnderecos.php?id=<?= $cliente_id ?>">Voltar</a>
            <a href="logout.php">Sair</a>
        </nav>
    </header>

    <div class="container">
        <?php if (!empty($mensagem)): ?>
            <div class="mensagem sucesso">
                <p><?= htmlspecialchars($mensagem) ?></p>
                <a href="gerenciarEnderecos.php?id=<?= $cliente_id ?>" class="btn">Voltar</a>
            </div>
        <?php endif; ?>

        <form method="POST">
          <label>CEP:</label>
          <input type="text" id="cep" name="cep" required>

          <label>Rua:</label>
          <input type="text" id="rua" name="rua" required>
         
          <label>Numero:</label>
          <input type="text" id="numero" name="numero" required>

          <label>Complemento:</label>
          <input type="text" id="complemento" name="complemento">

          <label>Bairro:</label>
          <input type="text" id="bairro" name="bairro" required>

          <label>Cidade:</label>
          <input type="text" id="cidade" name="cidade" required>

          <label>Estado:</label>
          <input type="text" id="estado" name="estado" required>

            <button type="submit">Cadastrar Endereço</button>
        </form>
    </div>
</body>
</html>
