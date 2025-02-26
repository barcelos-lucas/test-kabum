<?php
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/services/clienteServices.php';

$pdo = conectarBanco();

if (!$pdo) {
    die("sem conexão com o banco");
}

echo "<h2>Testando listagem de clientes</h2>";
$clientes = listarClientes($pdo);
echo "<pre>";
print_r($clientes);
echo "</pre>";

$nome = "usuario_teste8";
$data_nascimento = "1990-05-15";
$cpf = "00123456978";
$rg = "SP-12.345.867";
$telefone = "(31) 98765-4321";

$enderecos = [
    [
        'rua' => 'Rua das Flores',
        'numero' => '100',
        'complemento' => 'Apto 10',
        'bairro' => 'Centro',
        'cidade' => 'Belo Horizonte',
        'estado' => 'MG',
        'cep' => '30130-000'
    ]
];

//tentativa de RG ou CPF ou os dois duplicados
echo "<h2>Testando inserção de cliente</h2>";
if (function_exists('adicionarClientes')) {
    $novoCliente = adicionarClientes($pdo, $nome, $data_nascimento, $cpf, $rg, $telefone, $enderecos);
    echo $novoCliente ? "Cliente cadastrado com sucesso!<br>" : "Erro ao cadastrar cliente.<br>";
} else {
    echo "Erro: Função `adicionarClientes()` não encontrada!<br>";
}
echo "<h2>Testando inserção com CPF e RG duplicados</h2>";
try {
    $duplicado = adicionarClientes($pdo, "Outro Cliente", "1985-10-10", $cpf, $rg, "(11) 99999-9999", $enderecos);
    echo $duplicado ? "Erro: CPF e RG duplicados foram aceitos! <br>" : "Duplicação rejeitada corretamente <br>";
} catch (Exception $e) {
    echo "Erro esperado ao cadastrar cliente duplicado: " . $e->getMessage() . "<br>";
}



echo "<h2>Clientes depois de inserir</h2>";
$clientesAtualizados = listarClientes($pdo);
echo "<pre>";
print_r($clientesAtualizados);
echo "</pre>";
?>
