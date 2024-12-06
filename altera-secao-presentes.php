<?php
require_once 'logica-usuario.php';
verificaUsuario(); 
verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

// Recebendo os dados do formulário
$presentes_titulo = $_POST["presentes_titulo"];
$presentes_subtitulo = $_POST["presentes_subtitulo"];
$tem_lista = $_POST["tem_lista"];
$pix = $_POST["pix"];
$pix_img_ant = $_POST['pix_img_ant'] ?? null; // Receber a imagem anterior, se enviada pelo formulário

// Lógica para o upload da imagem do Pix
$pix_img = $pix_img_ant; // Inicializando com a imagem anterior, como fallback

if (isset($_FILES['pix_img']) && $_FILES['pix_img']['error'] === UPLOAD_ERR_OK) {
    $extensao = strtolower(pathinfo($_FILES['pix_img']['name'], PATHINFO_EXTENSION)); // Pega a extensão do arquivo
    $pix_img = uniqid(time()) . '.' . $extensao; // Define o nome único do arquivo
    $diretorio = "upload/"; // Define o diretório para onde enviaremos o arquivo

    // Move o arquivo para o diretório especificado
    if (move_uploaded_file($_FILES['pix_img']['tmp_name'], $diretorio . $pix_img)) {
        // Verifica e exclui a imagem anterior, se existir
        if (!empty($pix_img_ant) && file_exists($diretorio . $pix_img_ant)) {
            unlink($diretorio . $pix_img_ant); // Remove o arquivo antigo
        }
    } else {
        // Caso o upload falhe, mantém a imagem anterior
        $pix_img = $pix_img_ant;
    }
}

// Chama a função para alterar a seção de presentes
if (alteraSecaoPresentes(
    $conexao,
    $presentes_titulo,
    $presentes_subtitulo,
    $pix,
    $pix_img,
    $tem_lista
)) {
    header("Location: personalizar-secao-presentes");
    die();
} else { 
    ?>
    <h1>Algo deu errado:</h1>
    <?php
    printf("Connect failed: %s\n", mysqli_error($conexao));
    exit();
}
?>
