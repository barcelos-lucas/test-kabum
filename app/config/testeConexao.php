<?php
// Incluir o arquivo de configuração do banco de dados
require_once 'database.php'; // Ambos estão na mesma pasta, então basta usar o nome do arquivo diretamente

// Criar uma instância da classe Database
$database = new Database();

// Tentar conectar ao banco de dados
$conn = $database->conectarBanco();

// Verificar se a conexão foi bem-sucedida
if ($conn) {
    echo "Conexão com o banco de dados bem-sucedida!";
} else {
    echo "Erro na conexão com o banco de dados.";
}
