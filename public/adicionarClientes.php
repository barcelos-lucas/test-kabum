<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
            'numero' => trim($_POST["numero"]),
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
    <link rel="stylesheet" href="assets/css/adicionarClientes.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mask-plugin/1.14.16/jquery.mask.min.js"></script>
    <script src="assets/js/formsClientes.js"></script>
    <script src="assets/js/buscarCep.js"></script>
    <script src="assets/js/formataCampos.js" defer></script>


</head>
<body>
    <header class="adicionar-clientes">
        <h1>Adicionar Cliente</h1>
        <nav>
            <a href="dashboard.php" class="btn-header">Dashboard</a>
            <a href="clientes.php" class="btn-header">Gerenciar Clientes</a>
            <a href="logout.php" class="btn-header">Sair</a>
        </nav>
    </header>

    <div class="container">

        <?php if ($sucessoCadastro): ?> 
            <div class="mensagem sucesso">
                <p><?= htmlspecialchars($mensagem) ?></p>
                <a href="dashboard.php" class="btn-home">Home</a>
                <a href="adicionarClientes.php" class="btn-cadastrar-outro">Cadastrar Outro Cliente</a>
            </div>
        <?php endif; ?>

        <?php if (!empty($mensagem) && !$sucessoCadastro): ?> 
            <div class="mensagem erro">
                <p><?= htmlspecialchars($mensagem) ?></p>
            </div>
        <?php endif; ?>

        <?php if (!$sucessoCadastro): ?> 
            <form method="POST">
            <h2 class="subtitulo"> Dados pessoais </h2>
            <p class="campo-obrigatorio-msg"><span class="asterisco">*</span> indica um campo obrigatório</p>


            <label>Nome <span class="asterisco">*</span></label>
            <input type="text" name="nome" placeholder="Digite o nome completo" required>

            <label>Data de Nascimento <span class="asterisco">*</span></label>
            <input type="date" name="data_nascimento" required>

            <label>CPF <span class="asterisco">*</span></label>
            <input type="text" name="cpf" id="cpf" placeholder="000.000.000-00" required>

            <label>RG <span class="asterisco">*</span></label>
            <input type="text" name="rg" id="rg" placeholder="00.000.000-0" required maxlength="12">

            <label>Telefone <span class="asterisco">*</span></label>
            <input type="text" name="telefone" placeholder="(XX) XXXXX-XXXX" required maxlength="15">


        <h2 class="subtitulo"> Endereço</h2>
            <label>CEP <span class="asterisco">*</span></label>
            <input type="text" id="cep" name="cep" placeholder="Digite o CEP" required>

            <label>Rua <span class="asterisco">*</span></label>
            <input type="text" id="rua" name="rua" placeholder="Digite a rua" required>

            <label>Número <span class="asterisco">*</span></label>
            <input type="text" name="numero" placeholder="Digite o número" required>

            <label>Complemento:</label>
            <input type="text" name="complemento" placeholder="Apto, bloco, etc.">

            <label>Bairro <span class="asterisco">*</span></label>
            <input type="text" id="bairro" name="bairro" placeholder="Digite o bairro" required>

            <label>Cidade <span class="asterisco">*</span></label>
            <input type="text" id="cidade" name="cidade" placeholder="Digite a cidade" required>

            <label>Estado <span class="asterisco">*</span></label>
            <select id="estado" name="estado" required>
                    <option value="">Selecione o estado</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                </select>
            <div class="botoes">
                <a href="clientes.php" class="btn-cancelar">Cancelar</a>
                <button type="submit" class="btn-confirmar">Adicionar</button>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
