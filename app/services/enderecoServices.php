<?php
//Lista endereços por CLIENTE
function listarEnderecosPorCliente($pdo, $cliente_id) {
    $sql = "SELECT id, rua, numero, complemento, bairro, cidade, estado, cep FROM enderecos WHERE cliente_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cliente_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
