<?php
// Inicia a sessão no início do script
session_start();

if (!empty($_POST)) {
    // Filtra os inputs
    $nome = filter_input(INPUT_POST, 'nm_u', FILTER_SANITIZE_STRING);
    $senha = $_POST['senha_u'];
    $email = filter_input(INPUT_POST, 'email_u', FILTER_SANITIZE_EMAIL);

    // Verifica campos obrigatórios
    if (empty($nome) || empty($email) || empty($senha)) {
        $_SESSION['msg'] = 'Todos os campos são obrigatórios!';
        header('Location: cadastro.php'); // Volta para o formulário
        exit;
    }

    // Criptografa a senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    include_once('C:/xampp/htdocs/dashboard/siteirmandade/conexaoIrm.php');

    try {
        $stmt = $conn->prepare("INSERT INTO usuario (nm_u, senha_u, email_u) VALUES (:nome, :senha, :email)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);

        if ($stmt->execute()) {
           
            header('Location: siteIrmandade.php');
            exit;
        } else {
            $_SESSION['msg'] = 'Erro ao cadastrar usuário';
            header('Location: cadastro.php');
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION['msg'] = 'Erro no banco de dados: ' . $e->getMessage();
        header('Location: cadastro.php');
        exit;
    }

    $conn = null;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Compra</title>
    <script type="text/javascript"
        src="https://gc.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=hvKk9NqCi8qHG9krsbELM3BpyrTlPql2Eh6fG-n89NrCu_TdvE3mdDwPjiY_qyFvQxLkTv7G_fyxVW4gaFWYM5TqdP2147GEp7gygJiRR_-WL5BvE50NZBTXzsS4OXzb7rRsUq5I_ZPXWIofMLod2PvEHZCc0jyPyAzDHFaYlIBj8Qk1HGlGTDo_zqCQnmqWtgp997uTnG7J3e1vq6tCNinADJLq_CBb2OduPwAEDYG83Mbeyzc-6CpQBOCHoDLy_7fnU7WzLt8zATCu1sq4M36EwqY-Jy4TCvsc4pTC4RsKFxgDzXSE93p9Td77qTX-q4rly1EJ0oDYXhS1ZbouZ-Lm8MBBJforDYUWM54PHLw9baWpEyl0aclc-XXMjW8Vm1krcpQEp-7sGFdfHNB9D3zv24wsr-Ir0jHZpnIFsGyUOJIxlNT0fxwzo_LpeSDlXcFzlHXHkFi1Pwbh4dpkMsge4MH1CE-nD5QWE2v0c3Pwt0_b960_-6V3x5TcivB-guFckjvKiwfmtGO7gDhbkcBUsSjrKgsT80smQLI2KI3qT_UkIREJJUBA7JZjEIF53kPSgEkUO4efBHAuhadkeOra-Mz3rXiXa0rfNP5YJcXCIYe2Zi0W6XUx0kMK-nVhgwGHJW5Rqps8UIQzdVX1F2mvflGWVKfdTUbWq75cNdTsnVtzs-mmLyfN1sgaVL1ir4LYynGmwriOfh3XI4FnRyPzx79u2OywFlD58bxRzD0hwzK6vJXf1Rm8L0vC3_oE6XgHnn7XL1csuRnRIpqpxFtbmzLpkO-ar5qsQechyPQGlJZNpQ-ysl7GQuKFUo2CNA3MwK_qv2pHXxXAmBWhzz26JbEsEAQU4po_xXHFyL2avN5d0bMyEUsdHVpbG8k8SbAEcPtdiDJs9nDse2Z5DbVahc_0OV7znLuafVM-O6yEBe3vuBSLBhwi_VDgCZEFacDGMOVOqChbcrWTKzPlJdRihj2SYnMDSTHuBv7qgMp-5GWpnvKmCKWsIXPKMsMf7GEn9iK_q6O-euG0uBzuQb-SIk6ccNmtu3PPmduzSS90NLw4HPKM2GDURJG_p6kZ4IoFgGYR4r-1ziekk7uO47x8DjsPgRSWqsS0SsTfwT-Oi0BC3xbDFEA8hcOgqaxMxqgDwInXfdqDlZS7KaKBiUyfdzumsAjxYbvBgRrYBdY5dL01fkMNDjJWTIhz3MDeCsyk_KViT7vdK9vF9X4Nmrj5c91YdiSWaWXdFHxmF185kM4T1CQEDuXd34Won98RpFha9DovzHPrQ_O_ADf8abm7d6gqvHzz_ahr63coHEtFz_FoJdSOelh-QSbpJIGRFZxLP4k3U4GWj35zWB0kQ-UkrWPSsNBFZWtpjYWnH7z8Ojlnk2dw7x1RVtBbodsGOZNTOLsR3cRGqAv898IjzH6cMn2Md6B1sU8rnqp9pYvvpVRBU46ptlyeFz-RWXgbYtkOJ5gFZj1xAqcwByKFBWfrNf51CY-OG9clH3YsCOs"
        charset="UTF-8"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="ttslogo.jpg" type="image/x-icon">

    <style>
        .custom-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            width: 100%;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        .container-fluid .row {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .col-4 {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;

        }

        footer {
            background-color: rgb(121, 124, 124);
            padding: 10px 0;
            margin-top: 125px;

        }

        footer .container-fluid {
            background-color: rgb(0, 0, 0);
        }

        footer .row {
            background-color: rgb(0, 0, 0);
        }

        footer .text-white {
            color: white;
        }
    </style>
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
                            <li class="nav-item"><a class="nav-link active" href="index.html">Home</a></li>
                            <li class="nav-item"><a class="nav-link active" href="produtos.html">Produtos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <!-- Formulário de Cadastro -->
    <div class="container-fluid mb-5 mt-5">

        <form action="#" method="POST">

            <div class="row mt-5">
                <div class="col"></div>
                <div class="col-6 border border-secondary rounded">
                    <div class="mb-3">
                        <h3 class=" text-center">Cadastro de Cliente</h3>
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nm_u" onblur="validarNome(this)">

                        <label class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email_u" onblur="validarEmail(this);"
                            required>
                        <span id="erroEmail" style="color: red;"></span>

                        <label class="form-label">Senha</label>
                        <input type="password" class="form-control" name="senha_u">


                    </div>
                    <div class="mb-3 text-center">
                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                        <input type="reset" class="btn btn-danger" value="Limpar">

                    </div>
                </div>
                <div class="col"></div>
            </div>
    </div>
    </form>
    <!-- Rodapé -->
    <footer>
        <div class="container-fluid ">
            <div class="row align-items-center">
                <div class="col-4 text-start text-white">
                    <h5 class="text-white" id="contato">Siga-nos:</h5>
                    <p class="text-white">Instagram: @Irmandadesports</p>
                </div>
                <div class="col-4 text-center">
                    <h5 class="text-white">Atendimento ao Cliente</h5>
                    <p><a class="dropdown-item text-white" href="https://www.reclameaqui.com.br/"
                            target="_blank">Reclame Aqui!</a></p>
                </div>
                <div class="col-4 text-end">
                    <p class="text-white">&copy; 2024 Ygor Matsumoto & Lucas Vicente. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validarEmail(input) {
            const email = input.value; // Pega o valor do input
            const regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Regex para validar e-mail
            const erroEmail = document.getElementById('erroEmail'); // Elemento para exibir o erro

            if (!regexEmail.test(email)) {
                erroEmail.textContent = "Formato de email inválido."; // Exibe mensagem de erro
                input.focus(); // Coloca o foco no campo de e-mail
                return false; // Retorna false para indicar que o e-mail é inválido
            } else {
                erroEmail.textContent = ""; // Limpa a mensagem de erro se o e-mail for válido
                return true; // Retorna true para indicar que o e-mail é válido
            }
        }

        // Validação no envio do formulário
        document.querySelector('form').addEventListener('submit', function (event) {
            const inputEmail = document.getElementById('email');
            if (!validarEmail(inputEmail)) {
                event.preventDefault(); // Impede o envio do formulário se o e-mail for inválido
            }
        });


        function validarNome(input) {
            const nome = input.value.trim(); // Pega o valor do input e remove espaços em branco no início e no fim
            const regexNome = /^[A-Za-zÀ-ÖØ-öø-ÿ\s']+$/; // Regex para validar nomes
            const erroNome = document.getElementById('erroNome'); // Elemento para exibir o erro

            // Verifica se o campo está vazio
            if (nome === "") {
                erroNome.textContent = "O campo nome é obrigatório.";
                input.focus(); // Coloca o foco no campo de nome
                return false; // Retorna false para indicar que o nome é inválido
            }
            // Verifica se o nome contém apenas letras, espaços e caracteres especiais comuns em nomes
            else if (!regexNome.test(nome)) {
                erroNome.textContent = "O nome não pode conter números ou caracteres especiais.";
                input.focus(); // Coloca o foco no campo de nome
                return false; // Retorna false para indicar que o nome é inválido
            }
            // Se tudo estiver correto
            else {
                erroNome.textContent = ""; // Limpa a mensagem de erro
                return true; // Retorna true para indicar que o nome é válido
            }
        }

        // Validação no envio do formulário
        document.querySelector('form').addEventListener('submit', function (event) {
            const inputNome = document.getElementById('nome');
            if (!validarNome(inputNome)) {
                event.preventDefault(); // Impede o envio do formulário se o nome for inválido
            }
        });

    </script>
</body>

</html>
