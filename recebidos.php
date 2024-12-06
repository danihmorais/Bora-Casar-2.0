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
            Presentes recebidos
            <small>consulta a lista de presentes confirmados pelos convidados</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Lista de Presentes Confirmados</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">


        <!-- TABELA -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Lista de Presentes Confirmados</h3>
                <!-- tools box -->
                <div class="pull-right box-tools">
                    <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
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
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>Data</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php if ($presentes != null) {
                            foreach ($presentes as $presente) {
                                if ($presente->confirmacao == 1) { ?>
                                <tr>
                                    <td><?= $presente->id ?></td>
                                    <td><?= $presente->titulo ?></td>
                                    <td>R$ <?= number_format($presente->valor, 2, ',', '.') ?></td>
                                    <td><a href="<?= $presente->link ?>" target="_blank">Abrir link</a></td>
                                    <td><?= $presente->nome_pessoa ?></td>
                                    <td><?= $presente->telefone ?></td>
                                    <td><?= implode('-', array_reverse(explode('-', $presente->data))) ?></td>
                                    <td>
                                        <a data-url="exclui-presenteconfirmado.php?id=" data-id="<?= $presente->id ?>" class="btn btn-default" data-toggle="modal" data-target="#modal-excluir"><i class="fa fa-thumbs-o-up"></i></a>
                                    </td>
                                </tr>
                                <?php }
                            }
                        } ?>

                        </tbody>
                    </table>
                
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Modals -->
<div class="modal fade" id="modal-excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header modal-danger">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Excluir</h4>
        </div>
        <div class="modal-body">
         <h4>Tem certeza que deseja excluir os dados da doação do presente? Ele retornará para a lista de Presentes.</h4>
        </div>
        <div class="modal-footer">
          <a type="button" class="btn btn-danger delete">Excluir</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
</div>

<!-- Scripts -->
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

<?php require_once 'footer.php'; ?>

<script>
    var menu = document.querySelectorAll('#liPresentes');
    var item = menu[0];
    item.classList.add("active");

    var submenu = document.querySelectorAll('#liCadRec');
    var item = submenu[0];
    item.classList.add("active");
</script>

<!-- MASK -->
<script src="js/jquery.mask.js"></script>
<script>
    $(document).ready(function() {
        $('.date').mask('00/00/0000');
        // Outros códigos de máscara
    });
</script>
