<?php
require_once 'database.php'; 

$database = new Database();

$conn = $database->conectarBanco();

if ($conn) {
    echo "Conexão com o banco de dados bem-sucedida!";
} else {
    echo "Erro na conexão com o banco de dados.";
}
