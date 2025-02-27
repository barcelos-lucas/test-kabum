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
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        atualizarEnderecos($pdo, $endereco_id, $_POST);
        $mensagem = "Endereço atualizado!";
        $endereco = buscarEnderecoPorId($pdo, $endereco_id); 
    } catch (Exception $e) {
        $mensagem = "Erro ao atualizar endereço: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Endereço</title>
    <link rel="stylesheet" href="assets/css/editarEnderecos.css">
    <script src="assets/js/buscarCep.js"></script>

</head>
<body>
    <header class="header-editar-enderecos">
        <h1>Editar Endereço</h1>
    </header>

    <div class="container">
        <?php if (!empty($mensagem)): ?>
        <div class="mensagem sucesso">
            <span>✅ <?= htmlspecialchars($mensagem) ?></span>
        </div>
    <?php endif; ?>

        <form method="POST">
            <label>CEP:</label>
            <input type="text" id="cep" name="cep" value="<?= htmlspecialchars($endereco['cep']) ?>" required onblur="buscarCEP()">

            <label>Rua:</label>
            <input type="text" id="rua" name="rua" value="<?= htmlspecialchars($endereco['rua']) ?>" required>

            <label>Número:</label>
            <input type="text" id="numero" name="numero" value="<?= htmlspecialchars($endereco['numero']) ?>" required>

            <label>Complemento:</label>
            <input type="text" id="complemento" name="complemento" value="<?= htmlspecialchars($endereco['complemento']) ?>">

            <label>Bairro:</label>
            <input type="text" id="bairro" name="bairro" value="<?= htmlspecialchars($endereco['bairro']) ?>" required>

            <label>Cidade:</label>
            <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($endereco['cidade']) ?>" required>

            <label>Estado:</label>
            <input type="text" id="estado" name="estado" value="<?= htmlspecialchars($endereco['estado']) ?>" required>

            <div class="botoes-acoes">
              <a href="gerenciarEnderecos.php?id=<?= $endereco['cliente_id'] ?>" class="btn-voltar">Voltar</a>
              <button type="submit" class="btn-salvar">Salvar</button>
            </div>
        </form>
    </div>

</body>
</html>
