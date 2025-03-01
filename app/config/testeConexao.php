<?php
require_once 'database.php'; 

$database = new Database();

try {
    $conn = $database->conectarBanco();
    echo "Conexão com o banco de dados bem-sucedida!";
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}
