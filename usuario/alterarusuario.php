<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['cd']) || !isset($_SESSION['email'])) {
  header('Location: siteirmandade.php');
  exit;
}
$cod = $_SESSION['cd'];

include_once('conexaoIrm.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro Compra</title>
  <link rel="stylesheet" href="cssconsulta.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="ttslogo.jpg" type="image/x-icon">
  <script type="text/javascript"
    src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=hvKk9NqCi8qHG9krsbELM3BpyrTlPql2Eh6fG-n89NrCu_TdvE3mdDwPjiY_qyFvQxLkTv7G_fyxVW4gaFWYM5TqdP2147GEp7gygJiRR_-WL5BvE50NZBTXzsS4OXzb7rRsUq5I_ZPXWIofMLod2PvEHZCc0jyPyAzDHFaYlIBj8Qk1HGlGTDo_zqCQnmqWtgp997uTnG7J3e1vq6tCNinADJLq_CBb2OduPwAEDYG83Mbeyzc-6CpQBOCHoDLy_7fnU7WzLt8zATCu1sq4M36EwqY-Jy4TCvsc4pTC4RsKFxgDzXSE93p9Td77qTX-q4rly1EJ0oDYXhS1ZbouZ-Lm8MBBJforDYUWM54PHLw9baWpEyl0aclc-XXMjW8Vm1krcpQEp-7sGFdfHNB9D3zv24wsr-Ir0jHZpnIFsGyUOJIxlNT0fxwzo_LpeSDlXcFzlHXHkFi1Pwbh4dpkMsge4MH1CE-nD5QWE2v0c3Pwt0_b960_-6V3x5TcivB-guFckjvKiwfmtGO7gDhbkcBUsSjrKgsT80smQLI2KI3qT_UkIREJJUBA7JZjEIF53kPSgEkUO4efBHAuhadkeOra-Mz3rXiXa0rfNP5YJcXCIYe2Zi0W6XUx0kMK-nVhgwGHJW5Rqps8UIQzdVX1F2mvflGWVKfdTUbWq75cNdTsnVtzs-mmLyfN1sgaVL1ir4LYynGmwriOfh3XI4FnRyPzx79u2OywFlD58bxRzD0hwzK6vJXf1Rm8L0vC3_oE6XgHnn7XL1csuRnRIpqpxFtbmzLpkO-ar5qsQechyPQGlJZNpQ-ysl7GQuKFUo2CNA3MwK_qv2pHXxXAmBWhzz26JbEsEAQU4po_xXHFyL2avN5d0bMyEUsdHVpbG8k8SbAEcPtdiDJs9nDse2Z5DbVahc_0OV7znLuafVM-O6yEBe3vuBSLBhwi_VDgCZEFacDGMOVOqChbcrWTKzPlJdRihj2SYnMDSTHuBv7qgMp-5GWpnvKmCKWsIXPKMsMf7GEn9iK_q6O-euG0uBzuQb-SIk6ccNmtu3PPmduzSS90NLw4HPKM2GDURJG_p6kZ4IoFgGYR4r-1ziekk7uO47x8DjsPgRSWqsS0SsTfwT-Oi0BC3xbDFEA8hcOgqaxMxqgDwInXfdqDlZS7KaKBiUyfdzumsAjxYbvBgRrYBdY5dL01fkMNDjJWTIhz3MDeCsyk_KViT7vdK9vF9X4Nmrj5c91YdiSWaWXdFHxmF185kM4T1CQEDuXd34Won98RpFha9DovzHPrQ_O_ADf8abm7d6gqvHzz_ahr63coHEtFz_FoJdSOelh-QSbpJIGRFZxLP4k3U4GWj35zWB0kQ-UkrWPSsNBFZWtpjYWnH7z8Ojlnk2dw7x1RVtBbodsGOZNTOLsR3cRGqAv898IjzH6cMn2Md6B1sU8rnqp9pYvvpVRBU46ptlyeFz-RWXgbYtkOJ5gFZj1xAqcwByKFBWfrNf51CY-OG9clH3YsCOs"
    charset="UTF-8"></script>
</head>
<body>
  
  <!-- Cabeçalho -->
  <header class="container-fluid custom-container" style="background-color: #010408;">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #010307">
      <div class="container-fluid d-flex justify-content-between">
        <div class="d-flex align-items-center">
          <img class="rounded-circle"
            src="https://img.freepik.com/vetores-premium/icone-de-design-do-logotipo-da-letra-is_679026-798.jpg"
            width="35" height="30">
          <a class="navbar-brand ms-2" style="font-family: 'Courier New', Courier, monospace;">
            <h5>IrmandadeSports</h5>
          </a>
        </div>
        <div class="d-flex">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item"><a class="nav-link active" href="siteirmandade.php">Home</a></li>
              <li class="nav-item"><a class="nav-link active" href="produtos.php">produtos</a></li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <!-- Formulário -->
  <main>
    <div class="container-fluid custom-container" style="width: 80%;">
      <form action="confirmaralterarusuario.php" method="POST">
        <div class="form-container">
          <h3 class=" text-center">Cadastro de Cliente</h3>
          <label class="form-label">Nome</label>
          <input type="text" class="form-control" name="nm_u">

          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email_u">

          <label class="form-label">Senha</label>
          <input type="password" class="form-control" name="senha_u">

          <label class="form-label">Telefone</label>
          <input type="text" class="form-control" name="tel_e" required>

          <form id="formPagamento" method="POST">
            <label class="form-label">Forma de pagamento</label>
            <select class="form-control" name="formpag_e" id="formpag_e" required>
              <option value="debito">Débito</option>
              <option value="credito">Crédito</option>
              <option value="pix">Pix</option>
            </select>
          </form>

          <label class="form-label">CEP</label>
          <input type="text" class="form-control" id="cep" name="cep_e" required onblur="pesquisacep(this.value);">

          <div class="mb-3 mt-2 text-center">
            <input type="submit" class="btn btn-primary" value="cadastrar">
            <input type="reset" class="btn btn-danger" value="Limpar">
          </div>
        </div>
      </form>
    </div>
  </main>

  <div class="col">
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

  <script>


    function limpa_formulário_cep() {
      document.getElementById('rua').value = "";
      document.getElementById('bairro').value = "";
      document.getElementById('cidade').value = "";
      document.getElementById('uf').value = "";
      document.getElementById('ibge').value = "";
    }

    function meu_callback(conteudo) {
      if (!("erro" in conteudo)) {
        document.getElementById('rua').value = conteudo.logradouro;
        document.getElementById('bairro').value = conteudo.bairro;
        document.getElementById('cidade').value = conteudo.localidade;
        document.getElementById('uf').value = conteudo.uf;
        document.getElementById('ibge').value = conteudo.ibge;
      } else {
        limpa_formulário_cep();
        alert("CEP não encontrado.");
      }
    }

    function pesquisacep(valor) {
      var cep = valor.replace(/\D/g, '');
      if (cep != "") {
        var validacep = /^[0-9]{8}$/;
        if (validacep.test(cep)) {
          document.getElementById('rua').value = "...";
          document.getElementById('bairro').value = "...";
          document.getElementById('cidade').value = "...";
          document.getElementById('uf').value = "...";
          var script = document.createElement('script');
          script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';
          document.body.appendChild(script);
        } else {
          limpa_formulário_cep();
          alert("Formato de CEP inválido.");
        }
      } else {
        limpa_formulário_cep();
      }
    }


    // Enviar dados via AJAX quando o select mudar
    $('#formpag_e').change(function () {
      var formpag = $(this).val(); // Captura o valor selecionado

      // Enviar dados via AJAX
      $.ajax({
        url: 'checkout.php', // Arquivo que irá processar os dados
        method: 'POST', // Método de envio
        data: { formpag_e: formpag }, // Dados que serão enviados
        success: function (response) {
          // Exibe a resposta no elemento com id "response"
          $('#response').html(response);
        }
      });
    });
  </script>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>

<?php


if (!empty($_POST)) {
  // Validação e sanitização dos dados
  $nome = filter_input(INPUT_POST, 'nm_u', FILTER_SANITIZE_STRING);
  $email = filter_input(INPUT_POST, 'email_u', FILTER_SANITIZE_EMAIL);
  $senha = password_hash($_POST['senha_u'], PASSWORD_DEFAULT); // Hash da senha
  $tel = filter_input(INPUT_POST, 'tel_e', FILTER_SANITIZE_STRING);
  $formpag = filter_input(INPUT_POST, 'formpag_e', FILTER_SANITIZE_STRING);
  $cep = filter_input(INPUT_POST, 'cep_e', FILTER_SANITIZE_STRING);

  // Array com as variáveis e seus nomes (para mensagens de erro)
  $campos = [
    'Nome' => $nome,
    'Email' => $email,
    'Senha' => $senha,
    'Telefone' => $tel,
    'Forma de Pagamento' => $formpag,
    'CEP' => $cep
  ];

  // Verifica se algum campo está vazio
  foreach ($campos as $campo => $valor) {
    if (empty($valor)) {
      echo "O campo '$campo' é obrigatório!";
      exit;
    }
  }

  // Obtém o código do usuário da sessão ou da URL
  if (isset($_GET['cd'])) {
    $cod = intval($_GET['cd']); // Usa o ID da URL
  } elseif (isset($_SESSION['cd'])) {
    $cod = $_SESSION['cd']; // Usa o ID da sessão
  } else {
    echo "Erro: Sessão inválida ou ID não fornecido.";
    exit;
  }

  // Inclui o arquivo de conexão
  include_once('conexaoIrm.php');}
?>