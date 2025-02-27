<?php
require_once 'database.php';

$database = new Database();
$conn = $database->conectarBanco();

if ($conn) {
    echo "Conexão bem-sucedida!";
} else {
    echo "Erro na conexão!";
}