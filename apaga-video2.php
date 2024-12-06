<?php 
require_once 'logica-usuario.php';
verificaUsuario(); 
verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $video_id = $_GET['id'];
    $infos = listaMeusite($conexao);
    
    if ($infos && $infos['video_presente'] == $video_id) {
        $video_path = "upload/videos/" . basename($infos['video_presente']); // Diretório do vídeo

        // Verifica se o arquivo existe antes de tentar excluí-lo
        if (file_exists($video_path)) {
            if (unlink($video_path)) {
                if (excluiVideo2($conexao, 1)) { 
                    header("Location: personalizar-video2");
                    exit();
                }
            } else {
                echo "Erro ao tentar excluir o vídeo.";
            }
        }
    }
} else {
    echo "Erro: Nenhum vídeo foi enviado na URL.";
}
?>