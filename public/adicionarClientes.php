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
$sucessoCadastro = false; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $data_nascimento = trim($_POST["data_nascimento"]);
    $cpf = trim($_POST["cpf"]);
    $rg = trim($_POST["rg"]);
    $telefone = trim($_POST["telefone"]);

    $enderecos = [];
    if (!empty($_POST["rua"])) {
        $enderecos[] = [
            'rua' => trim($_POST["rua"]),
            'numero' => trim($_POST["numero"] ?? ''),
            'complemento' => trim($_POST["complemento"]),
            'bairro' => trim($_POST["bairro"]),
            'cidade' => trim($_POST["cidade"]),
            'estado' => trim($_POST["estado"]),
            'cep' => trim($_POST["cep"])
        ];
    }

    try {
        if (adicionarClientes($pdo, $nome, $data_nascimento, $cpf, $rg, $telefone, $enderecos)) {
            $mensagem = "Cliente cadastrado com sucesso";
            $sucessoCadastro = true;
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
    <title>Adicionar Cliente</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mask-plugin/1.14.16/jquery.mask.min.js"></script>
    <script src="assets/js/formularioClientes.js"></script>
    <script src="assets/js/buscarCep.js"></script>

</head>
<body>
    <header>
        <h1>Adicionar Cliente</h1>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="clientes.php">Gerenciar Clientes</a>
            <a href="logout.php">Sair</a>
        </nav>
    </header>

    <div class="container">
        <?php if ($sucessoCadastro): ?> 
            <div class="mensagem sucesso">
                <p><?= htmlspecialchars($mensagem) ?></p>
                <a href="dashboard.php" class="btn">Home</a>
                <a href="adicionarClientes.php" class="btn btn-secundario">Cadastrar Outro Cliente</a>
            </div>
        <?php endif; ?>

        <?php if (!empty($mensagem) && !$sucessoCadastro): ?> 
            <div class="mensagem erro">
                <p><?= htmlspecialchars($mensagem) ?></p>
            </div>
        <?php endif; ?>

        <?php if (!$sucessoCadastro): ?> 
            <form method="POST">
                <label>Nome:</label>
                <input type="text" name="nome" required>

                <label>Data de Nascimento:</label>
                <input type="date" name="data_nascimento" required>

                <label>CPF:</label>
                <input type="text" id="cpf" name="cpf" required>

                <label>RG:</label>
                <input type="text" id="rg" name="rg" required>

                <label>Telefone:</label>
                <input type="text" id="telefone" name="telefone" required>

            <h3>Endereço</h3>

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

                <button type="submit">Cadastrar Cliente</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
