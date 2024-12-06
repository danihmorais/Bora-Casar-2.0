<?php
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
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
        Seção de Local
        <small>edite os dados do seu site</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li>Personalizar Página</li>
        <li class="active">Seção de Local</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <form action="altera-secao-local.php" method="POST" enctype="multipart/form-data">

        <!-- Cabecalho -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Insira as informações da seção de local:</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
              <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body pad" style="">
            <div class="box-body mb-1">
              <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <h4>Imagem de fundo:</h4>
                      <input value="<?= isset($infos['local_imagem']) ? $infos['local_imagem'] : ''; ?>" type="hidden" name="local_imagem_anterior">
                      
                      <?php if (!empty($infos['local_imagem'])): ?>
                      <img id="blah" src="upload/<?= ($infos['local_imagem']) ?>" class="thumbnail img-rounded img-md"/>
                      <input id="imgLocalInput" value="<?= ($infos['local_imagem']) ?>" type="file" name="local_imagem" class="form-control-file" accept=".jpg, .jpeg, .heic, .webp">
                      <br>
                      <a data-url="apaga-foto-local?id=" data-id="<?= $infos['local_imagem'] ?>" class="btn btn-danger" data-toggle="modal" data-target="#modal-excluir">
                        <i class="fa fa-trash-o"></i> Excluir
                            </a>
    
                        <?php else: ?>
                        <img id="blah" src="img/img.jpg" class="thumbnail img-rounded img-md" />
                        <input id="imgLocalInput" value="<?= ($infos['local_imagem']) ?>" type="file" name="local_imagem" class="form-control-file" accept=".jpg, .jpeg, .heic, .webp">
                    <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                      <h4>Titulo:</h4>
                      <textarea name="local_titulo" class="form-control"><?= htmlspecialchars($infos['local_titulo']) ?></textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                      <h4>Subtitulo:</h4>
                      <textarea name="local_subtitulo" class="form-control"><?= htmlspecialchars($infos['local_subtitulo']) ?></textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                      <h4>Terá quantos locais?:</h4>
                      <select name="locais" class="form-control">
                        <option value="1" <?= ($infos['locais'] == 1 ? 'selected' : '') ?>>1</option>
                        <option value="2" <?= ($infos['locais'] == 2 ? 'selected' : '') ?>>2</option>
                      </select>
                    </div>
                </div>
                
              </div>
            </div>
          </div>
                  <div class="row">
          <div class="center-block text-center">
            <input type="submit" class="btn btn-success btn-lg margin-bottom margin" value="Alterar">
          </div>
        </div>
        </div>

        <!-- /.row -->

        
      </form>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<div class="modal fade" id="modal-excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header modal-danger">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Excluir</h4>
        </div>
        <div class="modal-body">
          <h4>Tem certeza que deseja excluir a imagem?</h4>
        </div>
        <div class="modal-footer">
          <a type="button" class="btn btn-danger delete" data-id="e">Excluir</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>

<script>
  function readURL(input) {

if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function(e) {
    $('#blah').attr('src', e.target.result);
  }

  reader.readAsDataURL(input.files[0]);
}
}

$("#imgLocalInput").change(function() {
readURL(this);
});
</script>

<!-- Active Menu -->
<script>
var menu = document.querySelectorAll('#liPerso');
var item = menu[0];
item.classList.add("active");

var submenu = document.querySelectorAll('#liPersoSecaoLocal');
var item = submenu[0];
item.classList.add("active");
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
   var textareas = document.querySelectorAll("textarea.form-control");

   // Função para ajustar a altura
   function adjustHeight(txtarea) {
      txtarea.style.height = 'auto'; // Reseta a altura antes de calcular a nova
      txtarea.style.height = txtarea.scrollHeight + 'px';
   }

   // Ajusta a altura sempre que o conteúdo mudar
   textareas.forEach(function(txtarea) {
      txtarea.addEventListener('input', function() {
         adjustHeight(txtarea);
      });

      // Ajusta a altura no carregamento inicial
      adjustHeight(txtarea);
   });
});
</script>
