<?php
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'header.php';
require_once 'conecta.php';
require_once 'banco-meusite.php';

$infos = listaMeusite($conexao);
$fotos = listaFotos($conexao);

?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Upload de Fotos
        <small>edite os dados do seu site</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Upload de Fotos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


      <form action="adiciona-foto.php" method="POST" enctype="multipart/form-data">
        
        <!-- Fotos -->
        <div id="fotos" class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Insira as fotos para galeria:</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
              <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-plus"></i></button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.box-header -->

          <div class="box-body">

            <div class="col-md-6">
              <div class="form-group">
                <h4>Inserir foto:</h4>
                <img id="blah" src="img/img.jpg" class="thumbnail img-rounded img-md"/>
                <input required id="imgInp"  type="file" name="nova_foto" class="form-control-file">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <input type="submit" class="btn btn-success margin-bottom" value="Enviar foto">
              </div>
            </div>

            <div class="box-body mb-1">
              <div class="row">
                <div class="col-xs-12">
                <h4>Fotos enviadas:</h4>

                <?php
                
                if ($fotos != null) {
                  
                  foreach ($fotos as $foto) {
                    ?>
                    <div class="col-md-3 text-center">
                      <img src="upload/fotos/<?= $foto['nome'] ?>"  class="img-thumbnail thumbnail img-rounded img-cover mt-4">
                      <div class="col-md-12">
                        <a data-url="apaga-foto?id=" data-id="<?= $foto['id'] ?>" class="btn btn-danger" data-toggle="modal" data-target="#modal-excluir">
                          <i class="fa fa-trash-o"></i>
                        </a>                        
                      </div>
                    </div>
                    <?php
                    }

                } else {
                  ?> 
                    <h4 class="text-muted mt-4">Nenhuma foto encontrada...</h4>
                  <?php 
                }
                ?>
        
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
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

<!-- MODAL EXCLUIR -->
<div class="modal fade" id="modal-excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header modal-danger">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Excluir</h4>
        </div>
        <div class="modal-body">
          <h4>Tem certeza que deseja excluir a foto?</h4>
        </div>
        <div class="modal-footer">
          <a type="button" class="btn btn-danger delete" data-id="e">Excluir</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
</div>


<!-- Preview image upload -->
<script>
  // Preview da imagem
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgInp").change(function() {
    readURL(this);
  });

  // Active Menu
  var menu = document.querySelectorAll('#liUpFotos');
  var item = menu[0];
  item.classList.add("active");
</script>
