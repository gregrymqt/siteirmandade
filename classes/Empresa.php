<?php
class Empresa {
    private $conn;
    
    public function __construct() {
        $this->conn = Conexao::getConnection();
    }
    
    public function login($email, $senha) {
        $stmt = $this->conn->prepare("SELECT cd_em, email_em FROM empresa WHERE email_em = :email AND senha_em = :senha");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>