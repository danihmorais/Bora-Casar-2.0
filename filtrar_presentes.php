<?php
// Inclui a conexão com o banco de dados e as funções de presentes
include_once('banco-meusite.php');

$filtrar = isset($_GET['filtro']) ? $_GET['filtro'] : '';

// Verifica qual filtro foi selecionado
if ($filtrar == 'menor-preco') {
    // Chama a função para listar presentes do menor para o maior preço
    $presentes = listaPresentes1($conexao);
} elseif ($filtrar == 'maior-preco') {
    // Chama a função para listar presentes do maior para o menor preço
    $presentes = listaPresentes2($conexao);

} else {
    // Caso não tenha filtro, retorna a lista normal
    $presentes = listaPresentes($conexao); // Ou a função que retorna a lista padrão
}


// Agora, os presentes filtrados estarão disponíveis na variável $presentes
?>
