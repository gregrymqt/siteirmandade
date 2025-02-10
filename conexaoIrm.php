<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Conexão</title>
</head>
<body>
<?php 
$servername = "localhost:3306";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=irmandade", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo "Falha na conexão: " . $e->getMessage();
}

 ?>
</body>
</html>







