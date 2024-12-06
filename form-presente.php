<?php
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'header.php';
require_once 'conecta.php';
require_once 'banco-meusite.php';

$id = $_GET["id"];
$presente = listaPresente($conexao, $id);
$categorias = listaCategorias($conexao);

?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alterar presente
        <small>altere os dados do presente</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Alterar presente</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <form action="altera-presente.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">

        <!-- Presente -->
        <div id="fotos" class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Alterar presente:</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
              <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body pad">

            <div class="col-md-12 mb-3">

            <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <h4>Imagem do produto:</h4>
                    <div class="form-group text-center">
                      <img src="upload/presentes/<?= $presente->imagem ?>" id="blah" class="thumbnail img-rounded img-md"/>
                      <input value="<?= $presente->imagem ?>" type="file" name="presente_imagem" id="imgInp" class="form-control-file" accept=".jpg, .jpeg, .heic, .webp">
                      <input value="<?= $presente->imagem ?>" type="hidden" name="presente_imagem_anterior">
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <h4>Nome do produto: (*)</h4>
                    <textarea name="titulo" class="form-control"><?= ($presente->titulo) ?></textarea>
                  </div>
                </div>
 
                <div class="col-md-6">
                  <div class="form-group">
                    <h4>Preço Médio: (*)</h4>
                    <input name="valor" class="form-control money" value="<?= number_format($presente->valor, 2, ',', '.') ?>" placeholder="0">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <h4>Categoria:</h4>
                    <select name="categoria" class="form-control">
                    <option value="<?= $presente->categoriaId ?>" selected>
                      <?= $presente->categoria ?>
                   </option>
                    <?php foreach($categorias as $categoria) :?>
                    <?php if ( $categoria['nome'] != $presente->categoria) {
                      ?>
                      <option value="<?=$categoria['id']?>">
                        <?=$categoria['nome']?>
                      </option>
                    <?php 
                    } ?>

                    <?php endforeach ?>
                  </select>
                  </div>
                </div>
         
                <div class="col-md-6">
                  <div class="form-group">
                    <h4>Link: (*)</h4>
                    <textarea name="link" class="form-control"><?= ($presente->link) ?></textarea>
                  </div>
                </div>


          </div>
        </div>

        <!-- /.row -->
        <div class="row">
          <div class="center-block text-center">
            <input type="submit" class="btn btn-success btn-lg margin-bottom margin" value="Alterar">
          </div>
        </div>
        
      </form>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- Preview image upload -->
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

$("#imgInp").change(function() {
readURL(this);
});
</script>

<?php
require_once 'footer.php';
?>

<!-- Active Menu -->
<script>
var menu = document.querySelectorAll('#liPresentes');
var item = menu[0];
item.classList.add("active");

var submenu = document.querySelectorAll('#liCadProd');
var item = submenu[0];
item.classList.add("active");
</script>

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
