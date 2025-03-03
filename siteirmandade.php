<?php
session_start();

// Classe para gerenciar a conexão com o banco de dados
class Conexao {
    private $conn;

    public function __construct($dsn, $usuario, $senha) {
        try {
            $this->conn = new PDO($dsn, $usuario, $senha);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

// Classe para representar um usuário
class Usuario {
    private $email;
    private $senha;
    private $codigo;

    public function __construct($email, $senha, $codigo) {
        $this->email = $email;
        $this->senha = $senha;
        $this->codigo = $codigo;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getCodigo() {
        return $this->codigo;
    }

    public function verificarSenha($senhaFornecida) {
        return password_verify($senhaFornecida, $this->senha);
    }

    public static function buscarPorEmail($conn, $email) {
        $stmt = $conn->prepare("SELECT email_u, senha_u, cd_u FROM usuario WHERE email_u = :email");
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Usuario($row['email_u'], $row['senha_u'], $row['cd_u']);
        }

        return null;
    }
}

// Classe para gerenciar a autenticação
class Autenticador {
    private $conexao;

    public function __construct(Conexao $conexao) {
        $this->conexao = $conexao->getConnection();
    }

    public function autenticar($email, $senha, $destination) {
        // Buscar usuário pelo email
        $usuario = Usuario::buscarPorEmail($this->conexao, $email);

        if ($usuario && $usuario->verificarSenha($senha)) {
            // Armazenar dados na sessão
            $_SESSION['cd'] = $usuario->getCodigo();
            $_SESSION['email'] = $usuario->getEmail();

            // Validar e redirecionar com base no destino
            if ($this->isValidDestination($destination)) {
                $redirectPage = $this->getRedirectPage($destination);
                header("Location: $redirectPage");
                exit;
            } else {
                echo "Destino inválido.";
                exit;
            }
        } else {
            echo "<script>alert('Email ou senha incorretos.'); window.history.back();</script>";
            exit;
        }
    }

    private function isValidDestination($destination) {
        // Lista de destinos permitidos
        $allowedDestinations = ['destino1', 'destino2'];
        return in_array($destination, $allowedDestinations);
    }

    private function getRedirectPage($destination) {
        // Mapear destinos para URLs
        switch ($destination) {
            case 'destino1':
                return 'consulta_usuario.php';
            case 'destino2':
                return 'produtos.php';
            default:
                return 'pagina_default.php'; // Página padrão caso o destino seja inválido
        }
    }
}

// Execução do script
if (!empty($_POST['email']) && !empty($_POST['senha'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];
    $destination = isset($_POST['destination']) ? $_POST['destination'] : '';

    // Configuração da conexão com o banco de dados
    $dsn = 'mysql:host=localhost;dbname=irmandade;charset=utf8';
    $usuarioDB = 'root';
    $senhaDB = '';

    $conexao = new Conexao($dsn, $usuarioDB, $senhaDB);
    $autenticador = new Autenticador($conexao);

    // Realizar autenticação
    $autenticador->autenticar($email, $senha, $destination);
}
?>

<!doctype html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IrmandadeSports</title>
  <link rel="stylesheet" href="cssindex.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script type="text/javascript"
    src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=dkiJPDtZ-S0-bTOsaxx0iXC7RpPENuaYBES7ra_pgFLXKXcxTFVMB-d_6dwzXyh9dZpyM_wRZfw3Jwfe9BQrd43-9RypdRSPMxIn5K88dSt7uE0aiRMg1LGP-W2ZiwdVyJKmRJN30e6Man-3yEqyrsBAVegXyrdriS45NzuxHtnvrriZDMajlSsJkqSdrKGdPp_mveXlXjPH7IqBrfS7jt6w3sZimUyori3_kJ5Erus"
    charset="UTF-8"></script>
</head>

<body>


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
              <li class="nav-item"><a class="nav-link active" href="#sobrenos">Sobre Nós</a></li>

              <form class="d-flex" role="search">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-destination="destino1"
                  onclick="setDestination(this)" class="btn btn-primary">Login</button>
              </form>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>



  <!-- inicio modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Login</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="loginForm" method="POST" action="#">
            <!-- Campo oculto para armazenar o destino -->
            <input type="hidden" id="modal-destination" name="destination">

            <div class="mb-3">
              <label for="email" class="form-label">Email institucional</label>
              <input type="email" class="form-control" id="email" name="email" required>
              <div id="emailHelp" class="form-text">Nunca compartilharemos seu e-mail com mais ninguém.</div>
            </div>
            <div class="mb-3">
              <label for="senha" class="form-label">Senha</label>
              <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div id="cadastro" class="text-center">
              <font size="3">Caso não tenha cadastro
                <label style="color:blue" data-bs-toggle="modal" data-bs-target="#exampleModal2">clique aqui!</label>
              </font>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Sair</button>
              <input type="submit" class="btn btn-outline text-light" style="background-color:#1D67BF" value="Entrar"
                name="Entrar">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- fim do modal -->


  <!-- radio de cadastro -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Escolha um tipo</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" value="1">
            <label class="form-check-label" for="flexRadioDefault1">
            USUARIO
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" value="2">
            <label class="form-check-label" for="flexRadioDefault2">
              EMPRESA
            </label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="button" id="confirmar" class="btn btn-primary">Confirmar</button>
        </div>
      </div>
    </div>
  </div>



  <!-- fim -->


  <!-- carousel -->
  <div class="container-fluid" id="carousel">
  </div>
  <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="2100">
        <img src="https://imgnike-a.akamaihd.net/branding/home-sbf/touts/Banner-cosmic-speed-25-11-desk.jpg"
          class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="2100">
        <img src="imagens/adidas.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="2100">
        <img src="imagens/puma.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- carousel fim -->
  <br>
  <br>

  <!-- imagem das logos -->
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


  <p style="text-align: center; " id="produton" class="fs-2">Nike</p>



  <!-- cards dos produtos -->
  <div class="container text-center">
    <div class="row">
      <div class="col">
        <div class="card" style="width: 18rem;">
          <img src="https://imgnike-a.akamaihd.net/360x360/0262063XA8.jpg" class="card-img-top" alt="Nike Cortez 23">
          <div class="card-body">
            <h5 class="card-title">Nike Cortez 23</h5>
            <p class="card-text">R$ 712,49</p>
            <!-- Botão que abre o modal -->
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-destination="destino2"
              onclick="setDestination(this)" class="btn btn-primary">
              Compre já!
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- fim dos cards -->
  <hr>

  <!-- Sobre nós -->

  <p style="text-align: center;" class="fs-2">Sobre Nós</p>
  <div class="container text-center">
    <div class="row align-items-center">
      <div class="col-6">

        <h5 id="sobrenos">
          Em um ambiente cheio de computadores e códigos, um curso de informática foi o

          ponto de partida para a
          história de dois amigos que transformaram a amizade em um negócio promissor. O que começou como conversas
          informais sobre tecnologia entre aulas e projetos acabou evoluindo para a fundação de uma empresa de revenda
          de
          roupas esportivas.
          Tudo começou com interesses compartilhados. Ygor e Lucas, ambos apaixonados por esportes e inovação,
          perceberam
          que tinham mais em comum do que a programação. Durante os intervalos do curso, discutiam sobre como o
          mercado
          de
          de
          roupas esportivas crescia com a popularidade do estilo esportivo uma combinação de conforto e performance
          que conquistava consumidores de todas as idades.</h5>
      </div>
      <div class="col-6">
        <img src="imagens/Imagem do WhatsApp de 2024-12-01 à(s) 15.06.25_256ab180.jpg" id="imag" alt="" alt="">

      </div>
    </div>
  </div>


  <br><br>

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


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>

$(document).ready(function () {
      // Evento de clique no botão "Confirmar"
      $("#confirmar").click(function () {
        // Obtém o valor do radio button selecionado
        let redi = $("input[name='flexRadioDefault']:checked").val();

        // Verifica o valor e redireciona
        switch (redi) {
          case '1':
            alert("Você será redirecionado !");
            window.location.href = 'usuario/CadastroUsuario.php'; // Redireciona
            break;
          case '2':
            alert("Você será redirecionado !");
            window.location.href = 'empresa/CadastroEmpresa.php'; // Redireciona
            break;
          default:
            alert("Nenhuma opção selecionada!");
            break;
        }
      });
    });
    // Função para capturar o destino do botão e armazenar no campo oculto do modal
    function setDestination(button) {
      const destination = button.getAttribute('data-destination');
      document.getElementById('modal-destination').value = destination;
    }


  </script>


</body>


</html>