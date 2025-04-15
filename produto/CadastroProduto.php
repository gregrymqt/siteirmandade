<?php
session_start();
require_once 'produto.php';
include_once('C:/xampp/htdocs/dashboard/siteirmandade/conexao/conexaoIrm.php');


// Verifica se o usuário está logado
if (!isset($_SESSION['cd']) || !isset($_SESSION['email'])) {
    header('Location: siteirmandade.php');
    exit;
}
$cod = $_SESSION['cd'];

$produtoHandler = new Produto();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imgproduto'])) {
    $result = $produtoHandler->uploadImagem($cod);
    
    if ($result['success']) {
        echo "<script>alert('Upload realizado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro: ".addslashes($result['message'])."');</script>";
    }
}
$empresa = $produtoHandler->getEmpresa($cod);
$arquivos = $produtoHandler->getArquivos($cod);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Produto</title>
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

    <!-- Formulário de Cadastro do Produto -->
    <div class="container-fluid mb-5 mt-5">

        <form action="#" method="POST">

            <div class="row mt-5">
                <div class="col"></div>
                <div class="col-6 border border-secondary rounded">
                    <div class="mb-3">
                        <h3 class=" text-center">Cadastro do Produto</h3>
                        <label class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control" name="nm_produto">

                        <label class="form-label">Valor</label>
                        <input type="email" class="form-control" name="vl_produto">


                        <label class="form-label">Descrição do Produto</label>
                        <input type="password" class="form-control" name="ds_produto">

                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <span data-feather="home"></span>
                                <p class="text-center"> <img src="<?php echo $candidato['foto_produto']; ?>"
                                        width="95px" height="95px" class="rounded-circle" alt="..." id="logo-img">
                                </p>
                            </li>

                            <li class="nav-item">

                                <span data-feather="home" class="align-text"></span>
                                <form action="#" method="POST" enctype="multipart/form-data">
                                    <p class="card-text"> <label for="formFileSm" class="form-label">Escolha sua
                                            foto</label>
                                        <input class="form-control form-control-sm" id="formFileSm" type="file"
                                            name="imgproduto">
                                    <p class="text-center"><input type="submit" class="btn btn-outline-dark"
                                            name="enviar" value="Enviar"></p>
                                    </p>
                                </form>


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

    <script>

        const dropArea = document.getElementById('dropArea');
        const fileInput = document.getElementById('fileInput');
        const fileTable = document.getElementById('fileTable');
        const fileInfo = document.getElementById('fileInfo');
        const fileNameElement = document.getElementById('fileName');
        const fileContentElement = document.getElementById('fileContent');

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight() {
            dropArea.classList.add('highlight');
        }

        function unhighlight() {
            dropArea.classList.remove('highlight');
        }

        function handleFiles(files) {
            files = [...files];
            files.forEach(uploadFile);
        }

        async function uploadFile(file) {
            const formData = new FormData();
            formData.append('file', file);

            const response = await fetch('uploads.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                displayFileDetails(result.file);
            } else {
                alert('Erro ao armazenar o arquivo: ' + result.error);
            }
        }

        function displayFileDetails(file) {
            const tbody = fileTable.querySelector('tbody');
            const row = document.createElement('tr');
            row.innerHTML = `
        <td>${file.nome}</td>
        <td>${(file.tamanho / 1024).toFixed(2)} KB</td>
        <td>${new Date(file.data).toLocaleString()}</td>
    `;
            row.addEventListener('click', () => {
                fileNameElement.textContent = file.nome;
                // Exibe o conteúdo do arquivo no campo de conteúdo
                fileContentElement.textContent = file.conteudo; // Aqui exibimos o conteúdo recebido do servidor
                fileInfo.style.display = 'block';
            });
            tbody.appendChild(row);
            fileTable.style.display = 'table';
        }


        dropArea.addEventListener('dragenter', highlight);
        dropArea.addEventListener('dragover', highlight);
        dropArea.addEventListener('dragleave', unhighlight);
        dropArea.addEventListener('drop', unhighlight);

        dropArea.addEventListener('dragenter', preventDefaults);
        dropArea.addEventListener('dragover', preventDefaults);
        dropArea.addEventListener('dragleave', preventDefaults);
        dropArea.addEventListener('drop', preventDefaults);

        dropArea.addEventListener('drop', (e) => {
            let dt = e.dataTransfer;
            let files = dt.files;
            handleFiles(files);
        });

        fileInput.addEventListener('change', (e) => {
            let files = e.target.files;
            handleFiles(files);
        });

    </script>

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