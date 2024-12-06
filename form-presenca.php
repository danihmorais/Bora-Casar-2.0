<?php
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'header.php';
require_once 'conecta.php';
require_once 'banco-meusite.php';

$id = $_GET["id"];
$infos = listaPresenca($conexao, $id);

?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alterar presença
        <small>altere os dados da presença deste convidado</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Alterar presença</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">

      <form action="altera-presenca.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">

        <!-- Convidado -->
        <div id="fotos" class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Alterar presença</h3>
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
                <div class="col-md-12 mb-3">
                  <h4>Nome do convidado <span class="text-muted">(*)</span></h4>
                  <input name="nome" type="text" class="form-control" placeholder="Nome completo" value="<?= $infos["nome"] ?>" required>
                </div>
              </div>

              <div class="mb-3">
                <h4 for="telefone">Telefone <span class="text-muted">(*)</span></h4>
                <input 
    name="telefone" 
    type="text" 
    class="form-control phone_with_ddd" 
    pattern="^\(\d{2}\)\s?\d{4,5}-\d{4}$" 
    inputmode="numeric"
    required 
    placeholder="(11) 99999-9999" 
    oninput="setCustomPhoneMessage(this)" 
    oninvalid="this.setCustomValidity('Insira um telefone no formato (11) 99999-9999')">

<script>
function setCustomPhoneMessage(input) {
    // Limpa a mensagem de erro personalizada se o valor for válido
    if (input.validity.patternMismatch) {
        input.setCustomValidity('Insira um telefone no formato (11) 99999-9999');
    } else {
        input.setCustomValidity(''); // Limpa a mensagem de erro personalizada se o valor for válido
    }
}
</script>
              </div>

              <div class="mb-3">
                <h4>Total de pessoas</h4>
                <input name="total_pessoas" type="number" name="total_pessoas" class="form-control" placeholder="Total de pessoas" value="<?= $infos["total_pessoas"] ?>" required>
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

<?php
require_once 'footer.php';
?>

<!-- MASK -->
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