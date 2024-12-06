<?php 
require_once 'logica-usuario.php';
verificaUsuario(); 
verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

$id = $_GET['id']; // Obtém o ID da foto a ser excluída

// Consulta ao banco para obter o nome do arquivo da foto baseado no ID
$query = "SELECT nome FROM fotos WHERE id = ?";
$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $nomeFoto);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if ($nomeFoto) {
    $fotoPath = 'upload/fotos/' . $nomeFoto;

    // Exclui o arquivo somente se ele existir
    if (file_exists($fotoPath) && unlink($fotoPath)) {
        // Exclui o registro no banco de dados
        if (excluiFoto($conexao, $id)) {
            header("Location: fotos");
            exit();
        } else {
            echo "Erro ao excluir do banco de dados: " . mysqli_error($conexao);
        }
    } else {
        echo "Erro ao excluir o arquivo ou o arquivo não existe.";
    }
} else {
    echo "Erro: Foto não encontrada.";
}
?>
