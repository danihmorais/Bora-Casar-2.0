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
        Informar doação
        <small>informa a doação recebida</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Informar doação</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

<?php if(isset($_GET["alteracao"]) && $_GET["alteracao"]==true) {
?>
    <div class="row">
      <div class="col-xs-8">
      <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Alteração realizada!</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <p>Alteração realizada com sucesso, confira em seus <a href="recebidos" target="_blank">presentes recebidos</a>.</p>
            </div>
            <!-- /.box-body -->
          </div>
      </div>
    </div>
<?php
  }
?>
      <form action="informa-doacao.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">

        <!-- Presente -->
        <div id="fotos" class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Informar doação:</h3>
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
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <h4>Nome do produto: (*)</h4>
                    <textarea name="titulo" readonly class="form-control"><?= ($presente->titulo) ?></textarea>
                  </div>
                </div>
 
                <div class="col-md-6">
                  <div class="form-group">
                    <h4>Preço Médio: (*)</h4>
                    <input name="valor" class="form-control money" value="<?= number_format($presente->valor, 2, ',', '.') ?>" readonly>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <h4>Categoria:</h4>
                    <input name="categoria" class="form-control" value="<?= $presente->categoria ?>" readonly> 
                    
                  </div>
                </div>
         
                <div class="col-md-6">
                  <div class="form-group">
                    <h4>Link: (*)</h4>
                    <textarea name="link" readonly class="form-control"><?= ($presente->link) ?></textarea>
                  </div>
                  </div>
                </div>

                <div class="col-12">
                            
                        <input type="hidden" name="id" value="<?= $presente->id ?>">

                            <label>Nome</label><span class="text-muted"> (*)</span>
                            <input name="nome_pessoa" class="form-control" maxlength="255" required placeholder="Nome completo">
                              <div class="text-right">
                              </div>
                          </div>
                       
                        <br>
                        <div class="col-12">
                            <label>Telefone</label><span class="text-muted"> (*)</span>
                          <input name="telefone" maxlength="30" required class="form-control phone_with_ddd" data-format="(dd) ddddd-dddd" required placeholder="(11) 99999-9999">
                              <div class="text-right">




          </div>
        </div>

          <div class="center-block text-center">
            <input type="submit" class="btn btn-success btn-lg margin-bottom margin" value="Salvar">

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
