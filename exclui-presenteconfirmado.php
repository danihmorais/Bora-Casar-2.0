<?php 
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

// Captura o ID passado via GET
$id = $_GET['id'];

// Define os campos que serão atualizados
$confirmacao = false;
$nome_pessoa = "";
$telefone = "";

// Chama a função de exclusão
if (excluiRecebido($conexao, $id, $nome_pessoa, $telefone, $confirmacao)) {
    // Redireciona de volta para a página de recebidos com sucesso
    header("Location: recebidos");
    die();
} else {
    // Em caso de erro, mostra o erro
    echo "<h1>Algo deu errado:</h1>";
    printf("Erro na conexão: %s\n", mysqli_errno($conexao));
    exit();
}
?>