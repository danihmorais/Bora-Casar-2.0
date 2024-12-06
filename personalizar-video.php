<?php
require_once 'logica-usuario.php';
verificaUsuario();
verificaAdmin();
require_once 'header.php';
require_once 'conecta.php';
require_once 'banco-meusite.php';

$infos = listaMeusite($conexao);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Vídeo principal
      <small>edite o vídeo inicial do seu site</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Upload de Vídeo</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <form id="videoForm" enctype="multipart/form-data">
      <!-- Vídeo -->
      <div id="fotos" class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Insira o vídeo inicial:</h3>
          <!-- tools box -->
          <div class="pull-right box-tools">
            <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-plus"></i>
            </button>
          </div>
          <!-- /. tools -->
        </div>
        <!-- /.box-header -->

        <div class="box-body">
          <div class="row">
            <!-- Coluna para o vídeo -->
            <div class="col-md-6">
              <div class="form-group">
                <h4>Inserir vídeo:</h4>
                <small>Se deixar sem nenhum vídeo, será encaminhado diretamente para o seu site</small>
                <p></p>
                <video id="videoPreview" controls width="320" height="240" class="thumbnail img-rounded img-md">
                  <?php if (!empty($infos['video'])): ?>
                    <source src="upload/videos/<?= $infos['video'] ?>" type="video/mp4">
                  <?php endif; ?>
                  Seu navegador não suporta a tag de vídeo.
                </video>
                <input required id="videoInp" type="file" name="novo_video" accept="video/*" class="form-control-file">
                <input type="hidden" name="video_anterior" value="<?= $infos['video'] ?>">
              </div>
              <button type="submit" class="btn btn-success">Enviar vídeo</button>
              <a data-url="apaga-video?id=" data-id="<?= $infos['video'] ?>" class="btn btn-danger" data-toggle="modal" data-target="#modal-excluir"><i class="fa fa-trash-o"></i></a>
            </div>
          </div>
        </div>
      </div>
    </form>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
require_once 'footer.php';
?>

<!-- MODAL PROGRESSO -->
<div class="modal fade" id="modalProgresso" tabindex="-1" role="dialog" aria-labelledby="modalProgressoLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalProgressoLabel">Progresso do Upload</h5>
      </div>
      <div class="modal-body">
        <div id="progressContainer" style="width: 100%; background-color: #f3f3f3;">
          <div id="progressBar" style="width: 0%; height: 20px; background-color: #4caf50;"></div>
        </div>
        <div id="status" style="text-align: center; margin-top: 10px;">0% carregado</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript para preview do vídeo e barra de progresso -->
<script>
document.getElementById('videoInp').onchange = function(event) {
    var videoPreview = document.getElementById('videoPreview');
    var file = event.target.files[0];
    var url = URL.createObjectURL(file);
    videoPreview.src = url;
    videoPreview.load(); // Carregar o novo vídeo selecionado
};

document.getElementById('videoForm').onsubmit = function(event) {
    event.preventDefault();

    const formData = new FormData();
    const fileInput = document.querySelector('input[name="novo_video"]');
    formData.append('novo_video', fileInput.files[0]);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'adiciona-video.php', true);

    // Exibe o modal de progresso
    $('#modalProgresso').modal('show');

    xhr.upload.onprogress = function(event) {
        if (event.lengthComputable) {
            const percentComplete = (event.loaded / event.total) * 100;
            document.getElementById('progressBar').style.width = percentComplete + '%';
            document.getElementById('status').innerText = Math.round(percentComplete) + '% carregado';
        }
    };

    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('status').innerText = 'Upload completo!';
            setTimeout(function() {
                window.location.href = "personalizar-video"; // Redireciona ao concluir
            }, 2000); // Espera 2 segundos antes de redirecionar
        } else {
            document.getElementById('status').innerText = 'Erro no upload.';
        }
    };

    xhr.send(formData);
};
</script>

<!-- MODAL EXCLUIR -->
<div class="modal fade" id="modal-excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-danger">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Excluir</h4>
      </div>
      <div class="modal-body">
        <h4>Tem certeza que deseja excluir o vídeo?</h4>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-danger delete" data-id="e">Excluir</a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<script>
var menu = document.querySelectorAll('#liPerso');
var item = menu[0];
item.classList.add("active");

var submenu = document.querySelectorAll('#liPersoVideo');
var item = submenu[0];
item.classList.add("active");
</script>
