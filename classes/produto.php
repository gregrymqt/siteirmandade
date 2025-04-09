<?php
class Produto {
    private $conn;
    
    public function __construct() {
        $this->conn = Conexao::getConnection();
    }
    
    public function listarProdutos($limit = 3, $offset = 0) {
        $stmt = $this->conn->prepare("SELECT * FROM produto LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>