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
        Seção de Fotos
        <small>edite os dados do seu site</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li>Personalizar Página</li>
        <li class="active">Seção de Fotos</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <form action="altera-secao-fotos.php" method="POST" enctype="multipart/form-data">

       
        <!-- Mensagens -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Insira as informações da seção de fotos:</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
              <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body pad" style="">

            <div class="col-md-6">
              <div class="form-group">
                <h4>Título:</h4>
                <textarea name="fotos_titulo" class="form-control"><?= htmlspecialchars($infos['fotos_titulo']) ?></textarea>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <h4>Subtítulo:</h4>
                <textarea name="fotos_subtitulo" class="form-control"><?= htmlspecialchars($infos['fotos_subtitulo']) ?></textarea>
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

<?php
require_once 'footer.php';
?>

<!-- Preview image upload -->
<script>
  function readURL(input) {

if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function(e) {
    $('#imgMensagens').attr('src', e.target.result);
  }

  reader.readAsDataURL(input.files[0]);
}
}

$("#imgMensagensInput").change(function() {
readURL(this);
});
</script>

<!-- Active Menu -->
<script>
var menu = document.querySelectorAll('#liPerso');
var item = menu[0];
item.classList.add("active");

var submenu = document.querySelectorAll('#liPersoSecaoFotos');
var item = submenu[0];
item.classList.add("active");
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
   var txtarea = document.querySelector("textarea.form-control");

   // Função para ajustar a altura
   function adjustHeight() {
      txtarea.style.height = 'auto'; // Reseta a altura antes de calcular a nova
      txtarea.style.height = txtarea.scrollHeight + 'px';
   }

   // Ajusta a altura sempre que o conteúdo mudar
   txtarea.addEventListener('input', adjustHeight);

   // Ajusta a altura no carregamento inicial
   adjustHeight();
});
</script>
