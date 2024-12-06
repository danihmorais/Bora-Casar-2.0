<?php 
require_once 'logica-usuario.php';
verificaUsuario(); 
verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

$mensagens_titulo = $_POST["mensagens_titulo"];
$mensagens_subtitulo = $_POST["mensagens_subtitulo"];
$mensagens_quantidade = $_POST["mensagens_quantidade"];
$mensagens_imagem_ant = $_POST['mensagens_imagem_anterior'];
$diretorio = "upload/"; // Define o diretório para upload

// Define o nome da imagem como a imagem anterior por padrão
$mensagens_imagem = $mensagens_imagem_ant;

if ($_FILES['mensagens_imagem']['name'] != "") {
    $extensao = strtolower(substr($_FILES['mensagens_imagem']['name'], -4)); // Pega a extensão do arquivo
    $mensagens_imagem = uniqid(time()) . $extensao; // Define um nome único para o arquivo

    if (move_uploaded_file($_FILES['mensagens_imagem']['tmp_name'], $diretorio . $mensagens_imagem)) { // Efetua o upload
        if (file_exists($diretorio . $mensagens_imagem_ant)) { // Verifica se a imagem anterior existe
            unlink($diretorio . $mensagens_imagem_ant); // Remove a imagem antiga
        }
    } else {
        // Caso o upload falhe, mantém a imagem anterior
        $mensagens_imagem = $mensagens_imagem_ant;
    }
}

if (alteraSecaoMensagens($conexao, $mensagens_titulo, $mensagens_subtitulo, $mensagens_imagem, $mensagens_quantidade)) {
    header("Location: personalizar-secao-mensagens");
    die();
} else { 
    echo "<h1>Algo deu errado:</h1>";
    printf("Erro: %s\n", mysqli_error($conexao));
    exit();
}
?>