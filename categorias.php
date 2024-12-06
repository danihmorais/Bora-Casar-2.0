<?php
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'header.php';
require_once 'conecta.php';
require_once 'banco-meusite.php';

$categorias = listaCategorias($conexao);

?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Cadastro de categorias
        <small>adicione e remova as categorias de presentes</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Categorias</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">


  <form action="adiciona-categoria.php" method="POST" enctype="multipart/form-data">
    <!-- Cabecalho -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Adicionar categoria:</h3>
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
            <div class="col-md-12">
                <div class="form-group">
                  <h4>Nome da Categoria: (*)</h4>
                  <input type="text" name="categoria" maxlength="20" class="form-control" required>
                </div>
            </div>
            <div class="col-md-12">
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
            <h3 class="box-title">Editar ou Excluir</h3>
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
                    <th>Nome</th>
                    <th>Ações</th>
                  </tr>
                  </thead>
                  <tbody>

<?php foreach ($categorias as $categoria): ?>
    <tr>
        <td><?= $categoria['nome'] ?></td>
        <td class="text-center">
            <?php if ($categoria['nome'] !== "Diversos") { ?>
                <a href="form-categoria?id=<?= $categoria['id'] ?>" class="btn btn-default mr-1"><i class="fa fa-edit"></i></a>
                <a data-url="exclui-categoria?id=" data-id="<?= $categoria['id'] ?>" class="btn btn-danger" data-toggle="modal" data-target="#modal-excluir-<?= $categoria['id']?>">
                    <i class="fa fa-trash-o"></i>
                </a>
            <?php } ?>
        </td>
    </tr>

    <!-- Modal específico para cada categoria -->
    <div id="modal-excluir-<?= $categoria['id'] ?>" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Excluir Categoria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 style="text-align: justify;">
                        Tem certeza que deseja excluir a categoria <strong><?= $categoria['nome'] ?>? </strong>
                        Se você <strong>excluir</strong> a categoria, <strong>todos os presentes que estavam nessa categoria serão movidos para "Diversos"!</strong>
                    </h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="exclui-categoria?id=<?= $categoria['id'] ?>" class="btn btn-danger">Excluir</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

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

var submenu = document.querySelectorAll('#liCadCat');
var item = submenu[0];
item.classList.add("active");
</script>