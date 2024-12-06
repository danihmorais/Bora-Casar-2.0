<?php 
require_once 'logica-usuario.php';
verificaUsuario(); 
verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';
require_once('class/Presente.php');

$id = $_GET["id"];
$nome_pessoa = $_POST["nome_pessoa"];
$telefone = $_POST["telefone"];
$confirmacao = true;

// Atualizando diretamente os valores de 'nome_pessoa' e 'telefone'
if(informaDoacao($conexao, $id, $nome_pessoa, $telefone, $confirmacao)) {
    header("Location: presentes");
    die();
} else { 
    echo "<h1>Algo deu errado:</h1>";
    printf("Connect failed: %s\n", mysqli_error($conexao));
    exit();
}
?>
