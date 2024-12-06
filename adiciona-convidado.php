<?php 
require_once ('logica-usuario.php');
require_once ('conecta.php');
require_once ('banco-meusite.php');
require_once ('class/Convidado.php');

$data = date('Y-m-d');

$convidado = new Convidado();
$convidado->data = $data;
$convidado->nome = $_POST["nome"];
$convidado->telefone = $_POST["telefone"];
$convidado->total_pessoas = $_POST["total_pessoas"];

if(insereConvidado($conexao, $convidado))
{
    $email_data = [
    'nome' => $_POST["nome"],
    'telefone' => $_POST["telefone"],
    'total_pessoas' => $_POST["total_pessoas"],
];
    $email_data_json = escapeshellarg(json_encode($email_data));

    // Executando o script de envio de e-mail em segundo plano e salvando logs
    shell_exec("php email4.php $email_data_json > /dev/null 2>&1 &");
    
header ("Location: index?presenca=true#presenca");
die();
}else{ 
?>
<h1>Algo deu errado:</h1>
<?php
printf("Connect failed: %s\n", mysqli_error($conexao));
exit();
}