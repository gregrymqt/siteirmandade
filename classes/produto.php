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

 
    // Função para upload seguro de imagens
    public function uploadImagem($cd_em) {
        $targetDir = "img/produto/";
        
        // Verifica se o arquivo foi enviado corretamente
        if (!isset($_FILES["imgproduto"]) || $_FILES["imgproduto"]["error"] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'message' => 'Erro no envio do arquivo. Código: ' . $_FILES["imgproduto"]["error"]];
        }
    
        // Verifica e cria o diretório se necessário
        if (!file_exists($targetDir) && !mkdir($targetDir, 0755, true)) {
            return ['success' => false, 'message' => 'Falha ao criar diretório de upload'];
        }
    
        // Obtém a extensão do arquivo
        $imageFileType = strtolower(pathinfo($_FILES["imgproduto"]["name"], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    
        // Validações
        if (!in_array($imageFileType, $allowedExtensions)) {
            return ['success' => false, 'message' => 'Apenas arquivos JPG, JPEG, PNG e GIF são permitidos'];
        }
    
        if (!getimagesize($_FILES["imgproduto"]["tmp_name"])) {
            return ['success' => false, 'message' => 'O arquivo não é uma imagem válida'];
        }
    
        if ($_FILES["imgproduto"]["size"] > 500000) {
            return ['success' => false, 'message' => 'O arquivo é muito grande (máximo 500KB)'];
        }
    
        // Gera um nome único para o arquivo
        date_default_timezone_set('America/Sao_Paulo');
        $newFileName = date("Ymd-His") . '-' . uniqid() . '.' . $imageFileType;
        $targetFile = $targetDir . $newFileName;
    
        // Move o arquivo
        if (!move_uploaded_file($_FILES["imgproduto"]["tmp_name"], $targetFile)) {
            return ['success' => false, 'message' => 'Falha ao mover o arquivo enviado'];
        }
    
        // Atualiza o banco de dados
        try {
            $updateStmt = $this->conn->prepare("UPDATE produto SET foto_produto = :foto WHERE cd_em = :cod");
            $updateStmt->execute([':foto' => $targetFile, ':cod' => $cd_em]);
            
            if ($updateStmt->rowCount() === 0) {
                return ['success' => false, 'message' => 'Nenhum produto encontrado para atualização'];
            }
            
            return ['success' => true, 'message' => 'Upload realizado com sucesso!', 'filepath' => $targetFile];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erro ao atualizar o banco de dados: ' . $e->getMessage()];
        }
    }
    // Método para buscar dados da empresa
    public function getEmpresa($cd_em) {
        $stmt = $this->conn->prepare("SELECT * FROM empresa WHERE cd_em = :cd");
        $stmt->execute([':cd' => $cd_em]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para buscar arquivos
    public function getArquivos($cd_em) {
        $stmt = $this->conn->prepare("SELECT * FROM arquivos WHERE cd_em = :cd");
        $stmt->execute([':cd' => $cd_em]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}
?>