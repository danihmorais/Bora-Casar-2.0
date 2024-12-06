  <?php
  require_once 'conecta.php';
  require_once 'banco-meusite.php';
  require_once 'filtrar_presentes.php';
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
    header("Expires: 0");

  $infos = listaMeusite($conexao);
  $categorias = listaCategorias($conexao);
  ?>

<html lang="en">

  <head>

<!--
Arquitetura de layout por Blackrock Digital LLC.
Veja mais em:
https://github.com/BlackrockDigital/startbootstrap-agency/blob/gh-pages/LICENSE
-->
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= ($infos['titulo']) ?> (<?= date('d/m/Y', strtotime($infos['data_casamento'])) ?>)</title>
    <link rel="shortcut icon" type="image/png" href="dist/img/favicon.ico"/>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->

    <link href="css/lista-presentes.css" rel="stylesheet">
    <link href="css/tema-presentes.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">

<style>
        .play-button {
            background-color: #27ae60;
            color: white;
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            z-index: 10;

            /* Centraliza o botão */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%); /* Ajusta para que o centro do botão fique no centro da tela */
        }

        .play-button:hover {
            background-color: #2ecc71;
        }
        
</style>
  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container" style="max-width: 1300px;">
        <a class="navbar-brand js-scroll-trigger" href="/"><?= ($infos['brand']) ?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse animated fadeIn" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto"> 
          <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index">Início</a>
            </li>   
          <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index#section01">Sobre</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index#mensagens">Mensagens</a>
            </li>      
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="index#presenca">Presença</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index#local">Local</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="index#fotos">Fotos</a>
            </li> 
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
     <section id="presenca" class="presenca text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading"><?= ($infos['presentes_titulo']) ?></h2>
            <h3 class="section-subheading text-muted"><?= ($infos['presentes_subtitulo']) ?></h3>
          </div>
        </div>
        <div class="d-flex">
            <hr class="my-auto flex-grow-1" style="color:gray;">
            <div class="px-4" style="color:gray;">CATEGORIAS</div>
            <hr class="my-auto flex-grow-1" style="color:gray;">
        </div>              
        
        <div class="row d-flex justify-content-center">
        <button type="button" id="categoria" class="btn botao-categoria text-muted mostrarTodos">
          TODOS            
        </button>    
          <?php foreach($categorias as $categoria) :?>
            <button type="button" id="categoria" class="btn botao-categoria text-muted">
            <?=$categoria['nome']?>
            </button>    
          <?php endforeach ?>  
        </div>

      </div>

    



      <div class="dropdown" style="position: relative; display: inline-block;">
    <button class="dropbtn" 
            onclick="toggleDropdown()" 
            style="background-color: #4CAF50; color: white; padding: 10px; font-size: 16px; border: none; cursor: pointer;">
        Filtrar
    </button>
    <div class="dropdown-content" id="myDropdown" 
         style="display: none; position: relative; background-color: #f9f9f9; min-width: 160px; 
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
        <a href="#" onclick="filtrar('menor-preco')" 
           style="color: black; padding: 12px 16px; text-decoration: none; display: block;">
            Menor Preço
        </a>
        <a href="#" onclick="filtrar('maior-preco')" 
           style="color: black; padding: 12px 16px; text-decoration: none; display: block;">
            Maior Preço
        </a>
        <a href="lista-presentes" 
           style="color: black; padding: 12px 16px; text-decoration: none; display: block;">
            Remover Filtro
        </a>
    </div>
</div>

<script>
    function toggleDropdown() {
        var dropdown = document.getElementById("myDropdown");
        // Alterna a visibilidade do dropdown
        if (dropdown.style.display === "none" || dropdown.style.display === "") {
            dropdown.style.display = "block";
        } else {
            dropdown.style.display = "none";
        }
    }

    function filtrar(opcao) {
        // Redireciona para a mesma página com o filtro como parâmetro na URL
        window.location.href = "?filtro=" + opcao;
    }

    // Fecha o dropdown se o usuário clicar fora dele
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdown = document.getElementById("myDropdown");
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            }
        }
    }
</script>




      <!-- <a class="seta-section js-scroll-trigger" href="#mensagens"><i class="fas fa-angle-down animated pulse infinite"></i></a> -->
    </section>

    <!-- Lista -->
    <section class="lista">
      <div class="container mb-4">
        <div class="row d-flex justify-content-center">
        
          <!-- INI CARD TRANSFERENCIA -->
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="card-presentes d-flex justify-content-center text-center">
            <a href="" class="link text-center" data-toggle="modal" data-target="#modal-transferencia">
              <img class="card-img-top img-md3" src="img/pig.png" alt="Card image cap">
              <p class="card__titulo d-flex card__titulo justify-content-center align-items-center text-center">Transferir Valor</p>                    
              <p class="card__autor text-center">Transfira diretamente</p>
            <p class="card__preco text-center">para a gente =)</p>
              <span class="badge badge-presente mb-2">Transferência</span>
              </a>
              <button type="button" class="btn botao-comprar" data-toggle="modal" data-target="#modal-transferencia">
              Transferir valor
              </button>
            </div>
          </div>
          <!-- FIM CARD TRANSFERENCIA -->

          <?php
            if ($presentes != null) {
              foreach ($presentes as $presente) {

                if ($presente->confirmacao != 1) {
                ?>

                <div class="col-lg-3 col-md-4 mt-4" id="presente">
                  <a target="_blank" href="<?= ($presente->link) ?>" class="link">
                    <div class="card-presentes d-flex justify-content-center text-center">
                      <img class="card-img-top img-md3" src="upload/presentes/<?= $presente->imagem ?>" alt="Card image cap">
                      <p class="card__titulo d-flex card__titulo justify-content-center align-items-center text-center"><?= $presente->titulo ?></p>                    
                      <p class="card__autor text-center">Valor médio:</p>
                      <p class="card__preco text-center">R$ <?= number_format( $presente->valor, 2, ',', '.' ) ?></p>
                      <span class="badge badge-presente mb-2"><?= $presente->categoria ?></span>
                      <a target="_blank" href="<?= $presente->link ?>" class="btn botao-comprar">Comprar</a>
<button 
    type="button" 
    class="botao-adquirir" 
    data-toggle="modal" 
    data-target="#modal-confirma" 
    data-id="<?= $presente->id ?>" 
    data-titulo="<?= $presente->titulo ?>" 
    data-imagem="upload/presentes/<?= $presente->imagem ?>" 
    data-valor="<?= number_format($presente->valor, 2, ',', '.') ?>" 
    style="font-size: 14px;">
    Marcar como adquirido
</button>

                    </div>
                  </a>
                </div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Seleciona o modal
    const modal = document.getElementById("modal-confirma");

    // Escuta os cliques nos botões "Marcar como adquirido"
    document.querySelectorAll(".botao-adquirir").forEach(button => {
        button.addEventListener("click", function () {
            // Captura os valores dos atributos data
            const id = this.getAttribute("data-id");
            const titulo = this.getAttribute("data-titulo");
            const imagem = this.getAttribute("data-imagem");
            const valor = this.getAttribute("data-valor");

            // Atualiza os campos do modal
            modal.querySelector('input[name="id"]').value = id; // Campo oculto para o ID
            modal.querySelector(".card__titulo").textContent = titulo; // Título
            modal.querySelector(".card-img-top").src = imagem; // Imagem
            modal.querySelector(".card__preco").textContent = `R$ ${valor}`; // Valor
        });
    });
});
</script>


<script>
    function confirma() {
        const form = document.getElementById('formConfirmacao');
        const telefoneInput = form.querySelector('input[name="telefone"]');

        // Limpa mensagens personalizadas antes de validar
        telefoneInput.setCustomValidity('');

        // Valida o campo telefone
        if (!telefoneInput.value.match(/^\(\d{2}\)\s?\d{4,5}-\d{4}$/)) {
            telefoneInput.setCustomValidity('Por favor, insira um telefone válido no formato (11) 99999-9999 ou (11) 9999-9999');
        }

        // Verifica a validade geral do formulário
        if (!form.checkValidity()) {
            form.reportValidity(); // Exibe mensagens de erro personalizadas
            return; // Interrompe o envio caso inválido
        }

        // Se o formulário for válido, envia via fetch
        const formData = new FormData(form);

        fetch('confirmador-presente.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                // Sucesso: Fecha o modal de confirmação e abre o modal de vídeo
                $('#modal-confirma').modal('hide');
                $('#modal-video').modal('show');
            } else {
                console.error('Erro na resposta do servidor.');
            }
        })
        .catch(error => {
            console.error('Erro na requisição:', error);
        });
    }

    // Remove mensagens padrão ao digitar
    document.querySelector('input[name="telefone"]').addEventListener('input', function () {
        this.setCustomValidity(''); // Remove qualquer mensagem ativa
    });
</script>





<div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="formConfirmacao" novalidate style="margin-bottom: 0;">

<input type="hidden" name="id" value="">

<div class="form-group text-center">
    <label class="titulo-modal" style="margin-bottom: 5px; line-height: 0.8;">Deseja informar aos noivos que dará esse presente?</label>
    <img class="card-img-top img-md3" src="" style="margin-bottom: 20px;" alt="Imagem do presente">
    <p class="card__titulo" style="font-size: 18px; margin-bottom: 15px; padding-top: 0; height:auto"></p>
    <p class="card__preco text-center"></p>
</div>


                    <div class="form-group">
                        <label>Nome</label><span class="text-muted"> (*)</span>
                        <input name="nome_pessoa" class="form-control" maxlength="255" required placeholder="Nome completo">
                    </div>

                    <div class="form-group">
                        <label>Telefone</label><span class="text-muted"> (*)</span>
                        <input name="telefone" type="text" class="form-control phone_with_ddd" 
                         inputmode="numeric" required 
                        placeholder="(11) 99999-9999">
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" id="confirmar-presente" class="btn" style="background-color: rgb(0, 0, 255); color: white;" 
                            onmouseover="this.style.backgroundColor='rgb(0, 255, 0)'" onmouseout="this.style.backgroundColor='rgb(0, 0, 255)'" onclick="confirma()">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="modal-video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-body text-center">
                <?php if (isset($infos['video_presente']) && !empty($infos['video_presente']) && file_exists("upload/videos/{$infos['video_presente']}")): ?>
                    <!-- Exibe o vídeo -->
                    <div class="modal-header">
                <h5 class="modal-title">Vídeo de Presente</h5>
            </div>
                    <p></p>
                    <video id="intro-video" muted class="mx-auto d-block" style="max-width: 100%; height: auto;" playsinline webkit-playsinline>
                        <source src="upload/videos/<?= $infos['video_presente'] ?>" type="video/mp4">
                    </video>
                    <button class="play-button btn btn-success mt-3" id="playBtn">Play</button>
                <?php else: ?>
                    <div class="modal-header">
                    <h5 class="modal-title">Agradecimento</h5>
                    </div>
                    <div class="form-group">
                    <br>
                    <div><?= $infos['texto_presente'] ?></div>
                    </div>
                    <button id="" class="btn" style="background-color: rgb(0, 0, 255); color: white;" onmouseover="this.style.backgroundColor='rgb(0, 255, 0)'" 
    onmouseout="this.style.backgroundColor='rgb(0, 0, 255)'" onclick="location.href='lista-presentes';">Fechar</button>
                <?php endif; ?>
            </div>
            <?php if (isset($infos['video_presente']) && !empty($infos['video_presente']) && file_exists("upload/videos/{$infos['video_presente']}")): ?>
                <div class="modal-footer">
                    <button id="replay" class="btn btn-secondary">Reproduzir novamente</button>
                    <button id="confirmarPresente" class="btn" style="background-color: rgb(0, 0, 255); color: white;" onmouseover="this.style.backgroundColor='rgb(0, 255, 0)'" 
    onmouseout="this.style.backgroundColor='rgb(0, 0, 255)'" disabled>Fechar</button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const video = document.getElementById("intro-video");
    const playBtn = document.getElementById("playBtn");
    const replayBtn = document.getElementById("replay");
    const confirmBtn = document.getElementById("confirmarPresente");
    
    video.play();
    video.currentTime = 0.1;
    video.pause();
            
    // Iniciar o vídeo ao clicar no botão "Play"
    playBtn.addEventListener("click", function () {
        video.muted = false;
        video.play();
        playBtn.style.display = "none";
    });

    // Habilitar o botão de confirmação quando o vídeo terminar
    video.addEventListener("ended", function () {
        confirmBtn.disabled = false;
    });

    // Reiniciar o vídeo ao clicar no botão "Reproduzir novamente"
    replayBtn.addEventListener("click", function () {
        video.muted = false;
        video.currentTime = 0;
        video.play();
        confirmBtn.disabled = true;
        playBtn.style.display = "none";
    });

    // Fechar todos os modais ao clicar no botão "Confirmar Presente"
    confirmBtn.addEventListener("click", function () {
        window.location.href = 'lista-presentes';
    });

    // Enviar o formulário via AJAX ao clicar no botão "Confirmar"
    
});

</script>


                <?php 
                } else {
                ?> 

                <div class="col-lg-3 col-md-4 mt-4" id="presente">
                  <a target="_blank">
                    <div class="card-comprado d-flex justify-content-center text-center"">
                      <img class="card-img-top img-md3" src="upload/presentes/<?= $presente->imagem ?>" alt="Card image cap">
                      <p class="card__titulo d-flex card__titulo justify-content-center align-items-center text-center"><?= $presente->titulo ?></p>                    
                      <p class="card__autor text-center">Valor médio:</p>
                      <p class="card__preco text-center">R$ <?= number_format( $presente->valor, 2, ',', '.' ) ?></p>
                      <span class="badge badge-presente mb-2"><?= $presente->categoria ?></span>
                      <a>Adquirido</a>
                    </div>
                  </a>
                </div>
                
                <?php 
                }
              }
            } else {
              ?> 
                <h4 class="text-muted mt-5">Em breve...</h4>
              <?php 
            }
            ?>

        </div>
      </div>
    </section>

<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div style="text-align: center;"><?= $infos['titulo_banner'] ?></div>
      </div>
    </div>
  </div>
</footer>

<!-- ********************************** MODAL TRANSFERENCIA ********************************** -->
<div class="modal fade" id="modal-transferencia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
              <div class="modal-body">
              <form action="" id="form-transferencia" method="POST">
                  <div class="row">
                    <div class="col-xs-12 p-4">

                      <div class="row">
                        <div class="col-12">

                          <div class="form-group mt-1 text-center">
                              <label class="titulo-modal">Transferir Valor</label>
                          </div>

                          <div class="row text-center">
                            <p class="col-md-12 text-muted">Transfira um valor diretamente para os noivos.</p>
                          </div>

                          <div class="form-group row text-center">
    <div class="col-md-12 text-center mt-1 mb-1">
    <?php if (!empty($infos['pix'])): ?>
        <span class="h4 text-muted">PIX: <?= htmlspecialchars($infos['pix']) ?></span>
    <?php endif; ?>
        <?php if (!empty($infos['pix_img'])): ?>
            <h4 class="h5 text-muted">QRCode Pix</h4> <!-- Exibir texto -->
            <img class="card-img-top img-md3" src="upload/<?= htmlspecialchars($infos['pix_img']) ?>" alt="Card image cap">
        <?php endif; ?>
    </div>



                           


                            <!-- <div class="col-md-6 text-center">
                              <img src="img/pig.png" style="max-height: 100px;">
                            </div> -->
                          </div>

                          <div class="row text-center">
                            <p class="col-md-12 text-muted"><b>*Após fazer a transferência, envie-nos os dados abaixo.</b></p>
                          </div>
                        </div>

                        <!-- DIVISÓRIA -->
                        <div class="col-12 mt-1 mb-1">
                          <div class="d-flex mt-4 mb-4">
                            <hr class="my-auto flex-grow-1" style="border-top: 1px dashed lightgray;">
                          </div> 
                        </div>

                        <div class="col-12">
                          <div class="form-group mt-1">
                            <label>Nome</label><span class="text-muted"> (*)</span>
                            <input type="text" name="nome" maxlength="30" class="form-control" required>
                            <div class="text-right">
                            </div>
                          </div>
                        </div>

                        <div class="col-6">
                          <div class="form-group mt-1">
                            <label>Valor</label><span class="text-muted"> (*)</span>
                            <input name="valor" class="form-control money" maxlength="30" required>
                              <div class="text-right">
                              </div>
                          </div>
                        </div>

                        <div class="col-6">
                            <label id="telefone">Telefone</label> <span class="text-muted">(*)</span></label>
                            <input name="telefone" type="text" class="form-control phone_with_ddd"inputmode="numeric" required  placeholder="(11) 99999-9999">
                        </div>


                      </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" id="confirmar-presente" class="btn" style="background-color: rgb(0, 0, 255); color: white;" 
                            onmouseover="this.style.backgroundColor='rgb(0, 255, 0)'" onmouseout="this.style.backgroundColor='rgb(0, 0, 255)'" onclick="confirma2()">Confirmar</button>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    function confirma2() {
        const form = document.getElementById('form-transferencia');
        const telefoneInput = form.querySelector('input[name="telefone"]');

        // Limpa mensagens personalizadas antes de validar
        telefoneInput.setCustomValidity('');

        // Valida o campo telefone
        if (!telefoneInput.value.match(/^\(\d{2}\)\s?\d{4,5}-\d{4}$/)) {
            telefoneInput.setCustomValidity('Por favor, insira um telefone válido no formato (11) 99999-9999 ou (11) 9999-9999');
        }

        // Verifica a validade geral do formulário
        if (!form.checkValidity()) {
            form.reportValidity(); // Exibe mensagens de erro personalizadas
            return; // Interrompe o envio caso inválido
        }

        // Se o formulário for válido, envia via fetch
        const formData = new FormData(form);

        fetch('adiciona-transferencia.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                // Sucesso: Fecha o modal de confirmação e abre o modal de vídeo
                $('#modal-transferencia').modal('hide');
                $('#modal-video').modal('show');
            } else {
                console.error('Erro na resposta do servidor.');
            }
        })
        .catch(error => {
            console.error('Erro na requisição:', error);
        });
    }

    // Remove mensagens padrão ao digitar
    document.querySelector('input[name="telefone"]').addEventListener('input', function () {
        this.setCustomValidity(''); // Remove qualquer mensagem ativa
    });
</script>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/agency.min.js"></script>

<script src="js/adicionaFiltro.js"></script>
<script src="js/filtraPresentes.js"></script>

<!-- MASK -->
<script src="js/jquery.mask.js"></script>
<script>
$(document).ready(function(){
  $('.date').mask('00/00/0000');
  $('.time').mask('00:00:00');
  $('.date_time').mask('00/00/0000 00:00:00');
  $('.cep').mask('00000-000');
  $('.phone').mask('00000-0000');
  $('.phone_with_ddd').mask('(00) 00000-0000');
  $('.phone_us').mask('(000) 000-0000');
  $('.mixed').mask('AAA 000-S0S');
  $('.cpf').mask('000.000.000-00', {reverse: true});
  $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
  $('.money').mask('000.000.000.000.000,00', {reverse: true});
  $('.money2').mask("#.##0,00", {reverse: true});
  $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
    translation: {
      'Z': {
        pattern: /[0-9]/, optional: true
      }
    }
  });
  $('.ip_address').mask('099.099.099.099');
  $('.percent').mask('##0,00%', {reverse: true});
  $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
  $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
  $('.fallback').mask("00r00r0000", {
      translation: {
        'r': {
          pattern: /[\/]/,
          fallback: '/'
        },
        placeholder: "__/__/____"
      }
    });
  $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
});
</script>

  </body>

</html>
