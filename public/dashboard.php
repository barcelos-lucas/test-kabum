<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: formsLogin.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
    <header>
    <h1><a href="dashboard.php" class="titulo-link" >Portal Kabum</a></h1>
    <nav>
            <a href="dashboard.php">Inicio</a>
            <a href="logout.php">Sair</a>
        </nav>
    </header>
    <div class="container">
        <div class="welcome">
            Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!
        </div>
        <div class="grid">
            <div class="card">
                <h3>Clientes</h3>
                <p>Acesse o gerenciador de clientes para listar, incluir, editar e excluir clientes.</p>
                <a href="clientes.php">Gerenciar Clientes</a>
            </div>`
            <div class="card">
                <h3>Adicionar clientes</h3>
                <p>Adicione novos clientes para o cadastro</p>
                <a href="adicionarClientes.php">Adicionar Clientes</a>
            </div>
            <!-- <div class="card">
                <h3>Configurações</h3>
                <p>Altere as configurações</p>
                <a href="#">Acessar Configurações</a>
            </div> -->
        </div>
    </div>
</body>
</html>
