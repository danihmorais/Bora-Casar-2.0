<?php
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'header.php';
require_once 'conecta.php';
require_once 'banco-meusite.php';

$presentes = listaPresentes($conexao);
$categorias = listaCategorias($conexao);
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cadastro de presentes
        <small>administre a lista de presentes</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Lista de Presentes</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

  <form action="adiciona-presente.php" method="POST" enctype="multipart/form-data">
    <!-- Cabecalho -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Adicionar Presente:</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
          <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
            <i class="fa fa-minus"></i></button>
        </div>
        <!-- /. tools -->
      </div>

      
      <!-- Formulário -->
      <div class="box-body pad" style="">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group text-center">
                  <h4>Imagem do produto:</h4>
                  <img id="blah" src="img/img.jpg" class="thumbnail img-rounded img-md"/>
                  <input type='file' id="imgInp" type="file" name="imagem" class="form-control-file" accept=".jpg, .jpeg, .heic, .webp">
                </div> 
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <h4>Nome do produto: (*)</h4>
                  <textarea name="titulo" class="form-control"></textarea>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                  <h4>Preço médio: (*)</h4>
                  <input name="valor" class="form-control money" required>
                </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <h4>Categoria:</h4>
                <select name="codCategoria" class="form-control">
                  <?php foreach($categorias as $categoria) :?>
                  <option value="<?=$categoria['id']?>">
                    <?=$categoria['nome']?>
                   </option>
                   <?php endforeach ?>
                </select>
              </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                  <h4>Link: (*)</h4>
                  <textarea name="link" class="form-control"></textarea>
                </div>
            </div>

            <div class="col-md-6">
              <div class="row">
                <div class="center-block text-center mt-2">
                  <input type="submit" class="btn btn-success btn-lg margin-bottom margin" value="Adicionar">
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </form>

        <!-- TABELA -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Lista de Presentes Cadastrados</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
              <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body pad" style="">

          
              <div class="col-xs-12">
                <table id="tabela" class="table table-bordered table-striped text-center">
                  <thead>
                  <tr>
                    <th>#ID</th>
                    <th>Titulo</th>
                    <th>Valor Médio</th>
                    <th>Link</th>
                    <th>Categoria</th>
                    <th>Status</th>
                    <th>Ações</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                  foreach ($presentes as $presente) {
                  ?>
                        <td><?= $presente->id ?></td>
                        <td><?= $presente->titulo ?></td>
                        <td>R$ <?= number_format( $presente->valor, 2, ',', '.' ) ?></td>
                        <td><a href="<?= $presente->link ?>" target="_blank">Abrir link</a></td>
                        <td><?= $presente->categoria ?></td>
                        <td>
                        <?php
                          if($presente->confirmacao == 1) {
                        ?>
                          <p style="color: gray;">Adquirido</p>
                        <?php
                          } else {
                        ?>
                          <p style="color: #00a65a;">Disponível</p>
                        <?php
                          }
                        ?>
                        </td>
                        <td class="text-center">
                          <a href="form-recebe?id=<?= $presente->id ?>" class="btn btn-default mr-1"><i class="fa fa-thumbs-o-down"></i></a>
                          <a href="form-presente?id=<?= $presente->id ?>" class="btn btn-default mr-1"><i class="fa fa-edit"></i></a>       
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-excluir-<?= $presente->id ?>"><i class="fa fa-trash-o"></i></button>
<?php foreach ($presentes as $presente): ?>
  <!-- Modal exclusivo para cada item -->
  <div class="modal fade" id="modal-excluir-<?= $presente->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-<?= $presente->id ?>">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header modal-danger">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel-<?= $presente->id ?>">Excluir</h4>
        </div>
        <div class="modal-body">
          <h4 style="text-align: justify;">Tem certeza que deseja excluir o presente <strong><?= $presente->titulo ?>?</strong></h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <a href="exclui-presente.php?id=<?= $presente->id ?>" class="btn btn-danger delete">Excluir</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>

                        </td>
                    </tr>

                  <?php
                  }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
        </div>

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


<!-- MASK -->
<script src="js/jquery.mask.js"></script>
<script>
$(document).ready(function(){
  $('.date').mask('00/00/0000');
  $('.time').mask('00:00:00');
  $('.date_time').mask('00/00/0000 00:00:00');
  $('.cep').mask('00000-000');
  $('.phone').mask('0000-0000');
  $('.phone_with_ddd').mask('(00) 0000-0000');
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
