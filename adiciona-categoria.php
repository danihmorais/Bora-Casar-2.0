<?php 
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

$categoria = $_POST["categoria"];

if(insereCategoria($conexao,$categoria))
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