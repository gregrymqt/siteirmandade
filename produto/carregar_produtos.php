<?php
require_once 'conexao.php'; 

$offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

$produto = new Produto(); // Sua classe que contém listarProdutos()
$produtos = $produto->listarProdutos(3, $offset);

foreach ($produtos as $prod) {
    echo '<div class="col-md-4 mb-4">
        <div class="card">
            <img src="img/'.$prod['imagem'].'" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">'.$prod['nome'].'</h5>
                <p class="card-text">'.$prod['descricao'].'</p>
            </div>
        </div>
    </div>';
}

?>