<?php
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'header.php';
require_once 'conecta.php';
require_once 'banco-meusite.php';

$mensagens = listaMensagens($conexao);

?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mensagens Recebidas
        <small>administre as mensagens recebidas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Mensagens Recebidas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      
        <!-- Mensagens -->
        <div id="mensagens" class="box">
          <div class="box-header with-border responsive">
            <h3 class="box-title">Aprovação de mensagens:</h3>
            <!-- tools box -->
            <div class="pull-right box-tools">
              <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">

                    <div class="col-xs-12">
                          <table id="tabela" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>#ID</th>
                              <th>Nome</th>
                              <th>Telefone</th>
                              <th>Data</th>
                              <th>Mensagem</th>
                              <th>Aprovação</th>
                              <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
            
                            <?php
                            foreach ($mensagens as $mensagem) {
                            ?>
            
                                  <td><?= $mensagem['id'] ?></td>
                                  <td><?= $mensagem['nome'] ?></td>
                                  <td><?= $mensagem['telefone'] ?></td>
                                  <td><?= implode('-', array_reverse(explode('-', $mensagem['data']))) ?></td>
                                  <td><?= $mensagem['mensagem'] ?></td>
                                  <td>
                                  <?php
                                    if($mensagem['confirmacao'] == 1) {
                                  ?>
                                    <p style="color: #00a65a;">Confirmado</p>
                                  <?php
                                    } else {
                                  ?>
                                    <p style="color: #f56954;">Pendente</p>
                                  <?php
                                    }
                                  ?>
                                  </td>
                                  <td class="text-center">
                                    <a href="confirma-mensagem.php?id=<?= $mensagem['id'] ?>" class="btn btn-default mr-1 fa  fa-thumbs-o-up"></a>
                                    <a href="nega-mensagem.php?id=<?= $mensagem['id'] ?>" class="btn btn-default mr-1 fa fa-thumbs-o-down"></a>
                                    <a data-url="exclui-mensagem?id=" data-id="<?= $mensagem['id'] ?>" class="btn btn-danger" data-toggle="modal" data-target="#modal-excluir">
                                    <i class="fa fa-trash-o"></i>
                                    </a>
                                  </td>
                              </tr>
            
                            <?php
                            }
                            ?>
                            </tbody>
                          </table>
                  

                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            </div>       

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
         <h4>Tem certeza que deseja excluir a mensagem?</h4>
        </div>
        <div class="modal-footer">
          <a type="button" class="btn btn-danger delete">Excluir</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
</div>

<!-- Active Menu -->
<script>
var menu = document.querySelectorAll('#liMensagens');
var item = menu[0];
item.classList.add("active");
</script>