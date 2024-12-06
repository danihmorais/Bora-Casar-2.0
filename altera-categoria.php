<?php 
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

$nome = $_POST["nome"];
$id = $_GET["id"];

if(alteraCategoria($conexao, $id, $nome))
{
header ("Location: categorias");
die();
}else{ 
?>
<h1>Algo deu errado:</h1>
<?php
printf("Connect failed: %s\n", mysqli_error($conexao));
exit();
}
?>