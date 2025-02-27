<?php

function usuarioExiste($pdo, $email) {
    $sql = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $count = $stmt->fetchColumn();
    
    return $count > 0; 
}

function criarUsuario($pdo, $nome_usuario, $email, $senha, $cargo, $status) {
    if (usuarioExiste($pdo, $email)) {
        return false;
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT); 
    $sql = "INSERT INTO usuarios (nome_usuario, email, senha, cargo, status) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);  
    $stmt->execute([$nome_usuario, $email, $senha_hash, $cargo, $status]); 

    return true; 
}


function loginUsuario($pdo, $email, $senha) {
  $sql = "SELECT id, nome_usuario, email, senha, cargo, status FROM usuarios WHERE email = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$email]);
  $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($usuario && password_verify($senha, $usuario['senha'])) {
      if ($usuario['status'] !== 'ativo') {
          return "Usuário inativo!";
      }

      session_start();
      $_SESSION['usuario_id'] = $usuario['id'];
      $_SESSION['usuario_nome'] = $usuario['nome_usuario'];
      $_SESSION['usuario_email'] = $usuario['email'];
      $_SESSION['usuario_cargo'] = $usuario['cargo'];

      return $usuario;
  }

  return false;
}

?>
