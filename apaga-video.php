<?php 
require_once 'logica-usuario.php';
verificaUsuario(); 
verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $pix_img_id = $_GET['id'];
    $infos = listaMeusite($conexao);
    
    if ($infos && $infos['pix_img'] == $pix_img_id) {
        $pix_path = "upload/" . basename($infos['pix_img']); // Diretório

        // Verifica se o arquivo existe antes de tentar excluí-lo
        if (file_exists($pix_path)) {
            if (unlink($pix_path)) {
                if (excluiVideo($conexao, 1)) { 
                    header("Location: personalizar-secao-presentes");
                    exit();
                }
            } else {
                echo "Erro ao tentar excluir.";
            }
        }
    }
} else {
}
?>
