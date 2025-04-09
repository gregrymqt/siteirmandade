<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Conexão</title>
</head>
<body>
<?php
class Conexao {
    private static $conn;

    public static function getConnection() {
        if (!isset(self::$conn)) {
            try {
                self::$conn = new PDO("mysql:host=localhost:3306;dbname=irmandade", "root", "");
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
        return self::$conn;
    }
}

// Testando a conexão
try {
    $conn = Conexao::getConnection();
    // echo "<p>Conexão com o banco de dados estabelecida com sucesso!</p>";
    
    
    
} catch (PDOException $e) {
    echo "<p>Falha na conexão: " . $e->getMessage() . "</p>";
}
?>
</body>
</html>