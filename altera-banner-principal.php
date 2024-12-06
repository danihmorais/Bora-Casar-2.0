<?php 
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

$titulo = $_POST["titulo"];
$brand = $_POST["brand"];
$titulo_banner = $_POST["titulo_banner"];
$data_casamento = $_POST["data_casamento"];
$cabecalho_imagem_ant = $_POST['cabecalho_imagem_anterior'];
$diretorio = "upload/"; // Define o diretório para upload

// Define o nome da imagem como a imagem anterior por padrão
$cabecalho_imagem = $cabecalho_imagem_ant;

if ($_FILES['cabecalho_imagem']['name'] != "") {
    $extensao = strtolower(substr($_FILES['cabecalho_imagem']['name'], -4)); // Pega a extensão do arquivo
    $cabecalho_imagem = uniqid(time()) . $extensao; // Define um nome único para o arquivo

    if (move_uploaded_file($_FILES['cabecalho_imagem']['tmp_name'], $diretorio . $cabecalho_imagem)) { // Efetua o upload
        if (file_exists($diretorio . $cabecalho_imagem_ant)) { // Verifica se a imagem anterior existe
            unlink($diretorio . $cabecalho_imagem_ant); // Remove a imagem antiga
        }
    } else {
        // Caso o upload falhe, mantém a imagem anterior
        $cabecalho_imagem = $cabecalho_imagem_ant;
    }
}

if (alteraBannerPrincipal($conexao, $titulo, $brand, $cabecalho_imagem, $titulo_banner, $data_casamento)) {
    header("Location: personalizar-banner-principal");
    die();
} else { 
    echo "<h1>Algo deu errado:</h1>";
    printf("Erro: %s\n", mysqli_error($conexao));
    exit();
}
?>
