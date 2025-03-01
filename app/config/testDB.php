<?php
require_once 'database.php'; 
$database = new Database();
$conn = $database->conectarBanco();

if ($conn) {
    echo "Conexão com o banco de dados bem-sucedida!<br>";
    
    $sql = "SELECT * FROM clientes LIMIT 5"; 
    $stmt = $conn->query($sql);
    
    if ($stmt) {
        while ($row = $stmt->fetch()) {
            echo "ID: " . $row['id'] . " - Nome: " . $row['nome'] . "<br>"; 
        }
    } else {
        echo "Erro na consulta: " . $conn->errorInfo()[2];
    }
} else {
    echo "Erro na conexão com o banco de dados.";
}
?>
