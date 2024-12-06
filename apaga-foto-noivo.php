<?php 
require_once 'logica-usuario.php';
verificaUsuario(); 
verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

$foto_img = $_GET['id'];
$fotoPath = 'upload/' . $foto_img;

    if (file_exists($fotoPath)) {
        if (unlink($fotoPath)) {
            if (excluiFotoNoivo($conexao, 1)) {
                header("Location: personalizar-secao-boas-vindas-noivo");
                exit();
            } else {
                // Caso ocorra um erro ao atualizar o banco de dados
                echo "Erro ao excluir o registro do banco de dados: " . mysqli_error($conexao);
            }
        } else {
            // Caso ocorra erro ao excluir o arquivo
            echo "Erro ao excluir o arquivo ou o arquivo não existe.";
        }
    } else {
        // Caso o arquivo não exista
        echo "Arquivo não encontrado.";
} 
?>


