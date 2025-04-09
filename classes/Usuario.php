<?php
class Usuario {
    private $conn;
    
    public function __construct() {
        $this->conn = Conexao::getConnection();
    }
    
    public function login($email, $senha) {
        $stmt = $this->conn->prepare("SELECT cd_u, email_u FROM usuarios WHERE email_u = :email AND senha_u = :senha");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>