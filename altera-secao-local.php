<?php 
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

$local_titulo = $_POST["local_titulo"];
$local_subtitulo = $_POST["local_subtitulo"];
$local_imagem_ant = $_POST['local_imagem_anterior'];
$locais = $_POST["locais"];
$diretorio = "upload/"; // Define o diretório para upload

// Define o nome da imagem como a imagem anterior por padrão
$local_imagem = $local_imagem_ant;

if ($_FILES['local_imagem']['name'] != "") {
    $extensao = strtolower(substr($_FILES['local_imagem']['name'], -4)); // Pega a extensão do arquivo
    $local_imagem = uniqid(time()) . $extensao; // Define um nome único para o arquivo

    if (move_uploaded_file($_FILES['local_imagem']['tmp_name'], $diretorio . $local_imagem)) { // Efetua o upload
        if (file_exists($diretorio . $local_imagem_ant)) { // Verifica se a imagem anterior existe
            unlink($diretorio . $local_imagem_ant); // Remove a imagem antiga
        }
    } else {
        // Caso o upload falhe, mantém a imagem anterior
        $local_imagem = $local_imagem_ant;
    }
}

if (alteraSecaoLocal($conexao, $local_titulo, $local_subtitulo, $local_imagem, $locais)) {
    header("Location: personalizar-secao-local");
    die();
} else { 
    echo "<h1>Algo deu errado:</h1>";
    printf("Erro: %s\n", mysqli_error($conexao));
    exit();
}
?>
