<?php
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'header.php';
require_once 'conecta.php';
require_once 'banco.php';

$usuarios = listaUsuarios($conexao);

?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuário
        <small>altere a senha de usuário</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li>Cadastros</li>
        <li class="active">Usuários</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Todos os usuários:</h3>
            </div>
            <!-- /.box-header -->
            <!-- TABLE -->
            <div class="box-body table-responsive">
              <table id="tabela" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                 <th>ID</th>
                  <th>Nome</th>
                  <th>Email</th>
                  <th>Permissão</th>
                  <th class="text-center">Ações</th>
                </tr>
                </thead>
                
                <tbody>
                <?php
                foreach ($usuarios as $usuario) {
                ?>
                  <tr>
                      <td><?= $usuario['id'] ?></td>
                      <td><?= $usuario['nome'] ?></td>
                      <td><?= $usuario['email'] ?></td>
                      <td><?= $usuario['permissao'] ?></td>
                      <td class="text-center">
                        <a data-url="altera-usuario.php?id=" data-id="<?= $usuario['id'] ?>" class="btn btn-default mr-1" data-toggle="modal" data-target="#modal-altera"><i class="fa fa-lock"></i></a>                                                                                              
                      </td>
                  </tr>

                <?php
                }
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<!-- MODAL ALTERAR -->
<div class="modal fade" id="modal-altera" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header modal-success">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Alterar Usuário</h4>
        </div>
        <div class="modal-body">
          <form action="altera-usuario.php" id="form-altera" method="POST">
          <input type="hidden" name="id" value="<?= $usuario['id'] ?>"/>
            <div class="row">
              <div class="col-xs-12">
                <div class="row">
                  <div class="col-xs-12">
                  <div class="form-group mt-1">
                      <label>Nova senha:</label>
                      <input type="password" required name="password1" class="form-control">
                    </div>
                    <div class="form-group mt-1">
                      <label>Confirmar nova senha:</label>
                      <input type="password" required name="password2" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
          <button type="submit" form="form-altera" class="btn btn-success" value="Submit">Alterar</button>
        </div>
      </div>
    </div>
</div>

<?php
require_once 'footer.php';
?>

<!-- Active Menu -->
<script>
var menu = document.querySelectorAll('#liUser');
var item = menu[0];
item.classList.add("active");
</script>
