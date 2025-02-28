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
        Definir Local 02
        <small>edite os dados do seu site</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li>Personalizar Página</li>
        <li>Seção Local</li>
        <li class="active">Definir Local 02</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <form action="altera-secao-local-local02.php" method="POST" enctype="multipart/form-data">

        <!-- Cabecalho -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Insira as informações do local02:</h3>
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

                <div class="col-md-6">
                    <div class="form-group">
                        <h4>Imagem:</h4>
                      <input value="<?= isset($infos['local_local02_imagem']) ? $infos['local_local02_imagem'] : ''; ?>" type="hidden" name="local_local02_imagem_anterior">
                      
                      <?php if (!empty($infos['local_local02_imagem'])): ?>
                      <img id="blah" src="upload/<?= ($infos['local_local02_imagem']) ?>" class="thumbnail img-rounded img-md"/>
                      <input id="imgLocalInput" value="<?= ($infos['local_local02_imagem']) ?>" type="file" name="local_local02_imagem" class="form-control-file" accept=".jpg, .jpeg, .heic, .webp">
                      <br>
                      <a data-url="apaga-foto-local2?id=" data-id="<?= $infos['local_local02_imagem'] ?>" class="btn btn-danger" data-toggle="modal" data-target="#modal-excluir">
                        <i class="fa fa-trash-o"></i> Excluir
                            </a>
    
                        <?php else: ?>
                        <img id="blah" src="img/img.jpg" class="thumbnail img-rounded img-md" />
                        <input id="imgLocalInput" value="<?= ($infos['local_local02_imagem']) ?>" type="file" name="local_local02_imagem" class="form-control-file" accept=".jpg, .jpeg, .heic, .webp">
                    <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                      <h4>Titulo:</h4>
                      <textarea name="local_local02_titulo" class="form-control"><?= htmlspecialchars($infos['local_local02_titulo']) ?></textarea>
                    </div>
                </div>

                <?php
// Verifica se data_festa é igual a data_casamento
$checked = ($infos['data_local02'] === $infos['data_casamento']) ? 'checked' : '';
?>

                <div class="col-md-6">
  <div class="form-group">
    <h4>Mesma data do casamento?</h4>
    <input 
      type="checkbox" 
      id="mesmaData" 
      name="mesmaData" 
      <?= $checked ?>  
      onchange="atualizarDataFesta()">
  </div>
</div>

<div class="col-md-6" id="campoDataFesta" style="<?= ($checked ? 'display: none;' : 'display: block;') ?>">
  <div class="form-group">
    <h4>Data (Local 02):</h4>
    <input 
      value="<?= ($infos['data_local02']) ?>" 
      type="date" 
      id="dataFesta" 
      name="data_local02" 
      class="form-control">
  </div>
</div>

<script>
  // Valores das datas no PHP
  const dataCasamento = "<?= $infos['data_casamento'] ?>";
  const dataFestaInput = document.getElementById('dataFesta');
  const checkbox = document.getElementById('mesmaData');
  const campoDataFesta = document.getElementById('campoDataFesta');

  // Inicializa o valor de data_festa com a data do casamento, se o checkbox estiver marcado
  if (checkbox.checked) {
    dataFestaInput.value = dataCasamento;
    campoDataFesta.style.display = 'none';
  }

  // Função para atualizar o comportamento com base no checkbox
  function atualizarDataFesta() {
    if (checkbox.checked) {
      dataFestaInput.value = dataCasamento;
      campoDataFesta.style.display = 'none';
    } else {
      dataFestaInput.value = dataCasamento; // Limpa o campo para que o usuário possa selecionar outra data
      campoDataFesta.style.display = 'block';
    }
  }
</script>



                <div class="col-md-6">
                    <div class="form-group">
                      <h4>Horário:</h4>
                      <textarea name="local_local02_horario" class="form-control"><?= htmlspecialchars($infos['local_local02_horario']) ?></textarea>
                    </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <h4>Texto:</h4>                    
                    <textarea type="text" name="local_local02_texto" class="form-control"><?= ($infos['local_local02_texto']) ?></textarea>                     
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <span class="h4">Endereço: </span><span>(Coloque o endereço o mais completo possível)</p>
                    <textarea name="local_local02_mapa" class="form-control"><?= htmlspecialchars($infos['local_local02_mapa']) ?></textarea>
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


<div class="modal fade" id="modal-excluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header modal-danger">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Excluir</h4>
        </div>
        <div class="modal-body">
          <h4>Tem certeza que deseja excluir a imagem?</h4>
        </div>
        <div class="modal-footer">
          <a type="button" class="btn btn-danger delete" data-id="e">Excluir</a>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
</div>


<?php
require_once 'footer.php';
?>

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

$("#imgLocalInput").change(function() {
readURL(this);
});
</script>

<!-- Active Menu -->
<script>
var menu = document.querySelectorAll('#liPerso');
var item = menu[0];
item.classList.add("active");

var submenu = document.querySelectorAll('#liPersoSecaoLocal02');
var item = submenu[0];
item.classList.add("active");
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
