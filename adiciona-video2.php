<?php 
require_once 'logica-usuario.php';
verificaUsuario();
verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

// Obter o vídeo anterior do banco de dados
$query = "SELECT video_presente FROM meusite LIMIT 1";  // Alterado para buscar o vídeo atual
$resultado = mysqli_query($conexao, $query);
$dados = mysqli_fetch_assoc($resultado);
$video_anterior = $dados['video_presente']; // Nome do vídeo anterior

// Verificar se o arquivo foi enviado e se não houve erro
if (isset($_FILES['novo_video']) && $_FILES['novo_video']['error'] === UPLOAD_ERR_OK) {
    $novo_video_tmp = $_FILES['novo_video']['tmp_name'];
    $nome = $_FILES['novo_video']['name'];

    // Obter e validar a extensão do arquivo
    $extensao = strtolower(pathinfo($nome, PATHINFO_EXTENSION));
    $extensoesPermitidas = ['mp4', 'mov', 'avi'];
    
    if (!in_array($extensao, $extensoesPermitidas)) {
        echo "Formato de arquivo inválido. Apenas vídeos MP4, MOV e AVI são permitidos.";
        exit();
    }

    // Gerar nome único para o vídeo
    $novo_video = uniqid(time()) . '.' . $extensao;
    $destino = 'upload/videos/' . $novo_video;

    // Mover o arquivo para o diretório de destino
    if (@move_uploaded_file($novo_video_tmp, $destino)) {

        // Verificar se o vídeo anterior existe e removê-lo
        if (!empty($video_anterior) && file_exists('upload/videos/' . $video_anterior)) {
            unlink('upload/videos/' . $video_anterior); // Apaga o vídeo anterior
        }

        // Atualizar o banco de dados com o novo vídeo
        if (insereVideo2($conexao, $novo_video)) {
            header("Location: personalizar-video2");
            die();
        } else {
            printf("Erro na conexão com o banco de dados: %s\n", mysqli_error($conexao));
            exit();
        }
    } else {
        echo "Erro ao mover o vídeo para o diretório de destino.";
        exit();
    }
} else {
    echo "Nenhum vídeo foi enviado ou ocorreu um erro no upload.";
    exit();
}

?>
