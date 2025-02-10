<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['cd']) || !isset($_SESSION['email'])) {
    header('Location: siteirmandade.php');
    exit;
}
$cod = $_SESSION['cd'];

include_once('conexaoIrm.php');

$stmtArquivos = $conn->prepare("SELECT * FROM arquivos WHERE cd_e = :cd");
$stmtArquivos->execute(['cd' => $cd]);
$arquivos = $stmtArquivos->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM produto WHERE cd_e = :cd");
$stmt->execute(['cd' => $cd]);
$candidato = $stmt->fetch(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IrmandadeSports</title>
  <link rel="stylesheet" href="cssprodutos.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script type="text/javascript"
    src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=ZizR5Plb350x2LK5jNz9Tm0N3Owf-n_Ipzm1y5dAz0l3MNPOknmyCjbZzkPEWOCEul_YIHTmiIcly88azwOCUZzczUobeOhrzJna4n_3KEPHAcYa_nKNQ3RoQfXzbn4awnUZm5UIVMEkrHNsZZRURLAqYNmMWSVaU1JeQKrSOU6CYnX-j7xmi0XtbCOvDS-7qlXuAGbAYZ1Ox-ZKdUs5j2FnxgjN7azJm-Rl_ONDyhc"
    charset="UTF-8"></script>
</head>

<body id="produtosbody">
  <header class="container-fluid custom-container" style="background-color: #010408;">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #010307">
      <div class="container-fluid d-flex justify-content-between">
        <div class="d-flex align-items-center">
          <img class="rounded-circle" src="https://img.freepik.com/vetores-premium/icone-de-design-do-logotipo-da-letra-is_679026-798.jpg" width="35" height="30">
          <a class="navbar-brand ms-2" style="font-family: 'Courier New', Courier, monospace;"><h5>IrmandadeSports</h5></a>
        </div>
        <div class="d-flex">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
            
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>




  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-center" id="exampleModalLabel">Você deseja fazer logout?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Sair</button>
          <button type="button" class="btn btn-outline text-light" style="background-color:#1D67BF"
            id="sair">Sim</button>
        </div>
      </div>
    </div>
  </div>
  <br>


  <div class="card-container">
    <div class="card" style="width: 18rem;">
      <div class="card-header">
        Pedido
      </div>
      <div class="card-body">

        <table class="table">
          <thead>
            <tr>
              <th scope="col">Produto</th>
              <th scope="col">Qtd</th>
              <th scope="col">Total</th>
              <th scope="col">Ação</th>
            </tr>
          </thead>
          <tbody id="comanda-lista">

          </tbody>
        </table>
        <button id="finalizar-pedido" class="btn btn-primary btn-finalizar" onclick="finalizarPedido()">Finalizar
          Pedido</button>
      </div>
    </div>
  </div>

  <div class="container text-center " style="z-index: 1000; 
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
  padding: 10px 0; 
  ">
    <div class="row">
      <div class="col">
        <img style="height: 10px; width: 10px; " src="https://cdn-icons-png.flaticon.com/512/731/731962.png" alt="">
        <p class="fw-bold text-white"><a href="#produtoa" style="text-decoration: none; color: black;">Adidas</a></p>
      </div>
      <div class="col order-5">
        <img style="height: 10px; width: 10px; "
          src="https://cdn.icon-icons.com/icons2/3914/PNG/512/puma_logo_icon_248754.png" alt="">
        <p class="fw-bold"><a href="#produtop" style="text-decoration: none;color: black;">Puma</a></p>
      </div>
      <div class="col order-1">
        <img style="height: 10px; width: 10px; " src="https://cdn-icons-png.flaticon.com/256/732/732084.png" alt="">
        <p class="fw-bold"><a href="#produton" style="text-decoration: none;color: black;">Nike</a></p>
      </div>
    </div>
  </div>


  <hr> <br>

  <p id="produton" class="fs-2">Nike</p>





  <div class="container text-center ms-3">
    <div class="row">
      <div class="col">
        <div class="card" style="width: 18rem;">
          <img src="https://imgnike-a.akamaihd.net/360x360/0262063XA8.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Nike Cortez 23</h5>
            <p class="card-text">R$ 712,49</p>
            <button type="button" onclick="adicionarItem('Nike Cortez 23',  712.49)" class="btn btn-primary ">Compre
              já!</button>
          </div>
        </div>
      </div>

    </div>
  </div>

  

  <footer style="background-color: rgb(121, 124, 124);">
    <br>
    <div class="container-fluid" style="background-color: rgb(0, 0, 0);">
      <div class="row align-items-center" style="background-color: rgb(0, 0, 0);">
        <!-- Coluna Siga-nos -->
        <div class="col-4 text-start text-white">
          <h5 class="text-white" id="contato">Siga-nos:</h5>
          <p class="text-white">
            <img
              src="https://d1muf25xaso8hp.cloudfront.net/https://img.criativodahora.com.br/2024/01/criativo-65946738a901dMDIvMDEvMjAyNCAxNmg0Mg==.jpg?w=1000&h=&auto=compress&dpr=1&fit=max"
              width="24" height="24"> Instagram: @Irmandadesports<br>
            <img src="https://i.pinimg.com/736x/70/f9/36/70f936294a1f0f3949a9205df9340d5e.jpg" width="24" height="24">
            Facebook: @Irmandadesports<br>
            <img
              src="https://e7.pngegg.com/pngimages/551/579/png-clipart-whats-app-logo-whatsapp-logo-whatsapp-cdr-leaf-thumbnail.png"
              width="24" height="24"> Whatsapp: +55 (11)4002-8922<br>
            <img src="https://cdn-icons-png.flaticon.com/512/281/281769.png" width="25" height="20"> Email:
            Irmandadesports@gmail.com
          </p>
        </div>

        <!-- Coluna Atendimento ao Cliente -->
        <div class="col-4 text-center">
          <h5 class="text-white">Atendimento ao Cliente</h5>
          <p>
            <a class="dropdown-item text-white" href="https://www.reclameaqui.com.br/" target="_blank">Reclame Aqui!</a>
          </p>
        </div>

        <!-- Direitos Autorais -->
        <div class="col-4 text-end">
          <p class="text-white">
            &copy; 2024 Ygor Matsumoto & Lucas Vicente. Todos os direitos reservados.
          </p>
        </div>
      </div>
    </div>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#sair').click(function (event) {
        event.preventDefault(); // Impede o envio do formulário
        alert("Você deslogou");

        window.location.href = "index.html"; // Redireciona para outra página

      });
    });


    const comanda = {}; // Objeto para armazenar os itens da comanda

    function adicionarItem(nome, preco) {
      if (comanda[nome]) {
        comanda[nome].quantidade += 1;
        comanda[nome].total = (comanda[nome].quantidade * preco).toFixed(2);
      } else {
        comanda[nome] = { preco, quantidade: 1, total: preco.toFixed(2) };
      }
      atualizarComanda();
    }

    function removerItem(nome) {
      if (comanda[nome]) {
        comanda[nome].quantidade -= 1;
        if (comanda[nome].quantidade <= 0) {
          delete comanda[nome];
        } else {
          comanda[nome].total = (comanda[nome].quantidade * comanda[nome].preco).toFixed(2);
        }
        atualizarComanda();
      }
    }

    function atualizarComanda() {
      const comandaLista = document.getElementById('comanda-lista');
      comandaLista.innerHTML = ''; // Limpa a comanda atual

      for (const [nome, item] of Object.entries(comanda)) {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${nome}</td>
          <td>${item.quantidade}</td>
          <td>R$ ${item.total}</td>
          <td>
            <button onclick="adicionarItem('${nome}', ${item.preco})">+</button>
            <button onclick="removerItem('${nome}')">-</button>
          </td>
        `;
        comandaLista.appendChild(row);
      }
    }

    function finalizarPedido() {
      alert('Pedido finalizado com sucesso!');
      window.location.href = "checkout.php";

      console.log(comanda); // Aqui você pode processar o pedido como necessário
    }
  </script>

</body>

</html>
