<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['cd']) || !isset($_SESSION['email'])) {
  header('Location: siteirmandade.php');
  exit;
}
$cod = $_SESSION['cd'];


include_once('conexaoIrm.php');



$nome = filter_input(INPUT_POST, 'nm_u', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email_u', FILTER_SANITIZE_EMAIL);
$senha = password_hash($_POST['senha_u'], PASSWORD_DEFAULT); // Hash da senha
$tel = filter_input(INPUT_POST, 'tel_e', FILTER_SANITIZE_STRING);
$formpag = filter_input(INPUT_POST, 'formpag_e', FILTER_SANITIZE_STRING);
$cep = filter_input(INPUT_POST, 'cep_e', FILTER_SANITIZE_STRING);

try {
    // Inicia uma transação
    $conn->beginTransaction();

    // Update na tabela `usuario`
    $stmt = $conn->prepare("
            UPDATE usuario 
            SET nm_u = :nome,
                email_u = :email,
                senha_u = :senha
            WHERE cd_u = :cod
        ");
    $stmt->execute([
      ':cod' => $cod,
      ':nome' => $nome,
      ':email' => $email,
      ':senha' => $senha
    ]);

    // Update na tabela `entrega`
    $stmt = $conn->prepare("
            UPDATE entrega 
            SET tel_e = :tel,
                formpag_e = :formpag,
                cep_e = :cep
            WHERE cd_u = :cod
        ");
    $stmt->execute([
      ':cod' => $cod,
      ':tel' => $tel,
      ':formpag' => $formpag,
      ':cep' => $cep
    ]);

    // Confirma a transação
    $conn->commit();
    echo "Dados alterados com sucesso!";
    header('Location: consulta_usuario.php');
    exit;
  } catch (PDOException $e) {
    // Em caso de erro, desfaz a transação
    $conn->rollBack();
    echo "Erro ao alterar dados: " . $e->getMessage();
  }

?>