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
        Texto de agradecimento
        <small>edite o texto de agradecimento dos presentes do seu site</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li>Personalizar Página</li>
        <li class="active">Seção de Boas Vindas</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <form action="altera-texto-presente.php" method="POST" enctype="multipart/form-data">

        <!-- Seção de Boas Vindas -->
        <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Insira o texto de agradecimento dos presentes:</h3>
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
                <div class="col-md-12">
                  <div class="form-group">
                    <h4>Texto:</h4>
                    <small>Somente será usado se deixar sem nenhum vídeo no submenu "Vídeo de agradecimento"</small>
                    <p></p>
                    <textarea type="text" name="texto_presente" class="form-control"><?= ($infos['texto_presente']) ?></textarea>
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

<?php
require_once 'footer.php';
?>

<!-- Active Menu -->
<script>
var menu = document.querySelectorAll('#liPerso');
var item = menu[0];
item.classList.add("active");

var submenu = document.querySelectorAll('#liPersoTextoPre');
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
