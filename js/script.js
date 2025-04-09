document.addEventListener('DOMContentLoaded', function() {
    // Carregar mais produtos
    const carregarMaisBtn = document.getElementById('carregar-mais');
    let produtosCarregados = 3;
    
    if (carregarMaisBtn) {
        carregarMaisBtn.addEventListener('click', function() {
            fetch('produto/carregar_produtos.php?offset=' + produtosCarregados)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('produtos-container').innerHTML += data;
                    produtosCarregados += 3;
                    
                    if (produtosCarregados >= 6) {
                        carregarMaisBtn.style.display = 'none';
                    }
                });
        });
    }
});