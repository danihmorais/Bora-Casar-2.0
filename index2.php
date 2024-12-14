<?php
require_once 'conecta.php';
require_once 'banco-meusite.php';

// Inicia a sessão
session_start();

// Verifica se o redirecionamento foi feito da página index
if (isset($_GET['from_index'])) {
    $_SESSION['from_index2'] = true;  // Marca que o redirecionamento veio de index
}

// Tenta obter as informações do banco de dados
$infos = listaMeusite($conexao);

// Verifica se não foi possível obter as informações ou se o vídeo não existe
if (!$infos || !isset($infos['video']) || empty($infos['video']) || !file_exists("upload/videos/{$infos['video']}")) {
    // Redireciona para "index" caso o vídeo não exista ou as informações estejam ausentes
    header('Location: index');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ($infos['titulo']) ?> (<?= date('d/m/Y', strtotime($infos['data_casamento'])) ?>)</title>
    <link rel="shortcut icon" type="image/png" href="dist/img/favicon.ico"/>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden; /* Evita rolagem desnecessária */
        }

        /* Configura o vídeo para ocupar o máximo possível sem cortar */
        #intro-video {
            width: 100%; /* Garante que o vídeo use toda a largura */
            height: auto; /* Mantém a proporção da altura */
            max-height: 100%; /* Impede que o vídeo ultrapasse a altura da tela */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); /* Centraliza o vídeo */
        }

        /* Mantém o estilo original do botão Play */
        .play-button {
            font-family: Montserrat, -apple-system, BlinkMacSy;
            background-color: #27ae60;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: 500;
            border: 2px solid white;
            cursor: pointer;
            border-radius: 5px;
            z-index: 10;

            /* Centraliza o botão Play */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .play-button:hover {
            background-color: #2ecc71;
        }

        /* Mantém os estilos originais dos botões adicionais */
        .button1, .button2 {
            margin: 0; /* Remove margens extras */
            display: block; /* Garante que os botões sejam elementos de bloco */
            width: 100%; /* Garantir que ambos ocupem toda a largura do contêiner */
            text-align: center; /* Alinha o texto do botão ao centro */
        }

        /* Estilo do botão 1 */
        .button1 {
            font-family: Montserrat, -apple-system, BlinkMacSy;
            background-color: #27ae60;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: 500;
            border: 2px solid white;
            cursor: pointer;
            border-radius: 5px;
            z-index: 10;
            /* Adiciona uma margem inferior de 30px para espaçamento entre os botões */
            margin-bottom: 30px;
        }

        .button1:hover {
            background-color: #2ecc71;
        }

        /* Estilo do botão 2 */
        .button2 {
            font-family: Montserrat, -apple-system, BlinkMacSy;
            background-color: rgba(255, 255, 255, 0.25);
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: 500;
            border: 2px solid white;
            cursor: pointer;
            border-radius: 5px;
            z-index: 10;
        }

        .button2:hover {
            background-color: rgb(255, 255, 255); 
            color: rgb(141, 141, 141);
        }

        /* Alinhamento central dos botões adicionais */
        #actionButtons,
        #redirecionado {
            display: flex;
            flex-direction: column; /* Organiza os botões na vertical */
            justify-content: center; /* Centraliza verticalmente */
            align-items: center; /* Centraliza horizontalmente */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); /* Centraliza no centro da tela */
        }
    </style>

    <link href="css/index.css" rel="stylesheet">
    <link href="css/tema.css" rel="stylesheet">
</head>
<body>

    <div id="content" style="display: none;"> <!-- Conteúdo da página é ocultado até a verificação -->
        <!-- O vídeo de introdução (como pré-visualização) -->
        <video id="intro-video" playsinline webkit-playsinline muted>
            <source src="upload/videos/<?= $infos['video'] ?>" type="video/mp4">
            Seu navegador não suporta a tag de vídeo.
        </video>

        <!-- Botão Play -->
        <button class="play-button" id="playBtn">Play</button>

        <div id="actionButtons">
            <button id="btnReproduzir" class="button1">Reproduzir novamente</button>
            <button id="btnProsseguir" class="button2">Prosseguir</button>
        </div>

        <div id="redirecionado">
            <button id="btnReproduzir2" class="button1">Reproduzir novamente</button>
            <button id="voltar-site" class="button2">Voltar para o site</button>
        </div>
    </div>

    <script>
        const actionButtons = document.getElementById("actionButtons");
        const redirecionado = document.getElementById("redirecionado");
        const content = document.getElementById("content");

        actionButtons.style.display = "none";
        redirecionado.style.display = "none";

        document.addEventListener("DOMContentLoaded", function () {
            const video = document.getElementById("intro-video");
            const playBtn = document.getElementById("playBtn");
            const btnProsseguir = document.getElementById("btnProsseguir");
            const btnReproduzir = document.getElementById("btnReproduzir");
            const btnReproduzir2 = document.getElementById("btnReproduzir2");
            const voltarBtn = document.getElementById("voltar-site");
            const currentVideo = "<?= $infos['video'] ?>";
            const videoVisto = localStorage.getItem("videoVisto");
            const videoAssistido = localStorage.getItem("videoAssistido");
            const isRedirected = <?php echo isset($_SESSION['from_index2']) ? 'true' : 'false'; ?>;

            // Se foi redirecionado de index2, exibe o vídeo sem verificar se foi assistido
            if (isRedirected) {
                content.style.display = "block";  // Exibe o conteúdo
                video.play();
                    video.currentTime = 0.5;
                video.pause();

                playBtn.addEventListener("click", function () {
                        video.muted = false;  // Desativa o mudo
                        video.play();  // Inicia a reprodução com som
                        playBtn.style.display = "none";  // Esconde o botão Play
                    });
                    
                video.addEventListener("ended", function () {
                    // Após o vídeo terminar, redireciona diretamente para "index"
                    <?php unset($_SESSION['from_index2']); ?>
                    redirecionado.style.display = "block";
                    voltarBtn.addEventListener("click", function () {
                        window.location.href = "index";  // Redireciona para index
                    });
                    btnReproduzir2.addEventListener("click", function () {
                        redirecionado.style.display = "none"; // Esconde os botões novamente
                        video.currentTime = 0; // Reinicia o vídeo
                        video.play(); // Reproduz o vídeo novamente
                    });
                });
            } else {
                // Verifica se o vídeo foi assistido ou não
                if (!videoVisto || videoAssistido !== currentVideo) {
                    content.style.display = "block";  // Exibe o conteúdo
                    video.play();
                    video.currentTime = 0.5; // Reinicia o vídeo
                    video.pause();  // Pausa o vídeo de introdução

                    playBtn.style.display = "block"; // O botão Play deve ser visível

                    playBtn.addEventListener("click", function () {
                        video.muted = false;  // Desativa o mudo
                        video.play();  // Inicia a reprodução com som
                        playBtn.style.display = "none";  // Esconde o botão Play
                    });

                    video.addEventListener("ended", function () {
                        // Após o vídeo terminar, armazena que o vídeo foi assistido
                        localStorage.setItem("videoVisto", "true");
                        localStorage.setItem("videoAssistido", currentVideo);
                        actionButtons.style.display = "block"; // Mostra os botões
                    });
                    
                    btnReproduzir.addEventListener("click", function () {
                    video.currentTime = 0; // Reinicia o vídeo
                    video.play(); // Reproduz o vídeo novamente
                    actionButtons.style.display = "none"; // Esconde os botões
                    });

                    btnProsseguir.addEventListener("click", function () {
                    window.location.href = "index"; // Redireciona para a página principal
                    });

                    
                } else {
                    // Se o vídeo já foi visto, redireciona diretamente para index
                    window.location.href = "index";
                }
            }
        });
    </script>
</body>
</html>
