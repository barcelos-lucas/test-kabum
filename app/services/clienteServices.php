<?php

require_once __DIR__ . '/../config/database.php';

// Lista clientes
function listarClientes($pdo) {
    $sql = "SELECT * FROM clientes ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Buscar um cliente por ID
function buscarClientes($pdo, $id) {
    $sql = "SELECT * FROM clientes WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cliente) {
        $sql = "SELECT * FROM enderecos WHERE cliente_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $cliente['enderecos'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    return $cliente;
  }

function limparFormato($valor) {
  return preg_replace('/\D+/', '', trim($valor)); 
}

function validarCPF($cpf) {
  return strlen($cpf) === 11; 
}

function validarRG($rg) {
  return strlen($rg) === 9; 
}
//Check se o CPF existe
function cpfExiste($pdo, $cpf) {
  $sql = "SELECT COUNT(*) FROM clientes WHERE cpf = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$cpf]);
  return $stmt->fetchColumn() > 0;
}

//Check se o RG existe
function rgExiste($pdo, $rg) {
  $sql = "SELECT COUNT(*) FROM clientes WHERE rg = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$rg]);
  return $stmt->fetchColumn() > 0;
}

//Adicionar e valida dados clientes
function adicionarClientes($pdo, $nome, $data_nascimento, $cpf, $rg, $telefone, $enderecos) {
  try {

      $erros = [];

      $cpfLimpo = limparFormato($cpf);
      $rgLimpo = limparFormato($rg);
     

      if (!validarCPF($cpfLimpo)) {
            $erros[] = "CPF incorreto";
        }

      if (!validarRG($rgLimpo)) {
            $erros[] = "RG incorreto";
        }

      if (cpfExiste($pdo, $cpf)) {
          $erros[] = "CPF já cadastrado";
      }

      if (rgExiste($pdo, $rg)) {
          $erros[] = "RG já cadastrado";
      }

      if (!empty($erros)) {
          throw new Exception("Erro ao cadastrar cliente: " . implode(" e ", $erros) . ".");
      }

      $pdo->beginTransaction();  

      $sql = "INSERT INTO clientes (nome, data_nascimento, cpf, rg, telefone) VALUES (?, ?, ?, ?, ?)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$nome, $data_nascimento, $cpf, $rg, $telefone]);
      $cliente_id = $pdo->lastInsertId();

      if (!$cliente_id) {
          throw new Exception("Falha ao inserir o cliente no banco.");
      }

      $sql = "INSERT INTO enderecos (cliente_id, rua, numero, complemento, bairro, cidade, estado, cep) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $pdo->prepare($sql);

      foreach ($enderecos as $endereco) {
          $stmt->execute([$cliente_id, $endereco['rua'], $endereco['numero'], $endereco['complemento'], 
                          $endereco['bairro'], $endereco['cidade'], $endereco['estado'], $endereco['cep']]);
      }

      $pdo->commit();
      return true;
  } catch (Exception $e) {
      if ($pdo->inTransaction()) {
          $pdo->rollBack();
      }
      die($e->getMessage()); 
  }
}

function buscarClientePorId($pdo, $id) {
  $sql = "SELECT id, nome, data_nascimento, cpf, rg, telefone FROM clientes WHERE id = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id]);
  return $stmt->fetch(PDO::FETCH_ASSOC);
}

function atualizarCliente($pdo, $id, $nome, $data_nascimento, $cpf, $rg, $telefone) {
  try {
      $sql = "UPDATE clientes SET nome = ?, data_nascimento = ?, cpf = ?, rg = ?, telefone = ? WHERE id = ?";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$nome, $data_nascimento, $cpf, $rg, $telefone, $id]);

      return $stmt->rowCount() > 0; // Retorna true se pelo menos uma linha foi alterada
  } catch (Exception $e) {
      throw new Exception("Erro ao atualizar cliente: " . $e->getMessage());
  }
}

//Editar cliente e endereços
function editarClientes($pdo, $id, $nome, $data_nascimento, $cpf, $rg, $telefone, $enderecos) {
    try {
        $pdo->beginTransaction();

        $sql = "UPDATE clientes SET nome = ?, data_nascimento = ?, cpf = ?, rg = ?, telefone = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $data_nascimento, $cpf, $rg, $telefone, $id]);

        $sql = "DELETE FROM enderecos WHERE cliente_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        $sql = "INSERT INTO enderecos (cliente_id, rua, numero, complemento, bairro, cidade, estado, cep) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        foreach ($enderecos as $endereco) {
            $stmt->execute([$id, $endereco['rua'], $endereco['numero'], $endereco['complemento'], 
                            $endereco['bairro'], $endereco['cidade'], $endereco['estado'], $endereco['cep']]);
        }

        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollBack();
        return false;
    }
}

//Excluir cliente
function excluirClientes($pdo, $id) {
  try {
      $pdo->beginTransaction();

      // Exclui os endereços com vinculo ao cliente
      $sqlEnderecos = "DELETE FROM enderecos WHERE cliente_id = ?";
      $stmt = $pdo->prepare($sqlEnderecos);
      $stmt->execute([$id]);

      // Exclui o cliente
      $sqlCliente = "DELETE FROM clientes WHERE id = ?";
      $stmt = $pdo->prepare($sqlCliente);
      $stmt->execute([$id]);

      $pdo->commit();
      return true;
  } catch (Exception $e) {
      $pdo->rollBack();
      throw new Exception("Erro ao excluir cliente: " . $e->getMessage());
  }
}




?>
