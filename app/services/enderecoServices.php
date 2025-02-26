<?php
//Lista endereços por CLIENTE
function listarEnderecosPorCliente($pdo, $cliente_id) {
    $sql = "SELECT id, rua, numero, complemento, bairro, cidade, estado, cep FROM enderecos WHERE cliente_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cliente_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//Busca os endereços pelo ID
function buscarEnderecoPorId($pdo, $id) {
  $sql = "SELECT * FROM enderecos WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}



//Adiciona endereço
function adicionarEnderecos($pdo, $cliente_id, $rua, $numero, $complemento, $bairro, $cidade, $estado, $cep) {
  try {
    $sql = "INSERT INTO enderecos (cliente_id, rua, numero, complemento, bairro, cidade, estado, cep) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cliente_id, $rua, $numero, $complemento, $bairro, $cidade, $estado, $cep]);

    return true;
  }
  catch (Exception $e) {
    throw new Exception("Erro ao adicionar endereço: " . $e->getMessage());
  }  
}


function atualizarEnderecos($pdo, $id, $dados) {
  try {
      $sql = "UPDATE enderecos SET rua = ?, numero = ?, complemento = ?, bairro = ?, cidade = ?, estado = ?, cep = ? WHERE id = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([
          $dados['rua'], 
          $dados['numero'], 
          $dados['complemento'], 
          $dados['bairro'], 
          $dados['cidade'], 
          $dados['estado'], 
          $dados['cep'], 
          $id
      ]);

      return true;
  } catch (Exception $e) {
      throw new Exception("Erro ao atualizar endereço: " . $e->getMessage());
  }
}

function excluirEnderecos($pdo, $id) {
  try {
      $sql = "DELETE FROM enderecos WHERE id = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$id]);
      return true;
  } catch (Exception $e) {
      throw new Exception("Erro ao excluir endereço: " . $e->getMessage());
  }
}
