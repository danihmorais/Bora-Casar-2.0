<?php 
require_once 'logica-usuario.php';
verificaUsuario(); 
verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

$local_local01_titulo = $_POST["local_local01_titulo"];
$local_local01_horario = $_POST["local_local01_horario"];
$local_local01_texto = $_POST["local_local01_texto"];
$local_local01_mapa = $_POST["local_local01_mapa"];
$local_local01_imagem_ant = $_POST['local_local01_imagem_anterior'];
$diretorio = "upload/"; // Define o diretório para upload
$data_local01 = $_POST["data_local01"];

// Define o nome da imagem como a imagem anterior por padrão
$local_local01_imagem = $local_local01_imagem_ant;

if ($_FILES['local_local01_imagem']['name'] != "") {
    $extensao = strtolower(substr($_FILES['local_local01_imagem']['name'], -4)); // Pega a extensão do arquivo
    $local_local01_imagem = uniqid(time()) . $extensao; // Define o nome único do arquivo

    if (move_uploaded_file($_FILES['local_local01_imagem']['tmp_name'], $diretorio . $local_local01_imagem)) { // Efetua o upload
        if (file_exists($diretorio . $local_local01_imagem_ant)) { // Verifica se a imagem anterior existe
            unlink($diretorio . $local_local01_imagem_ant); // Remove a imagem antiga
        }
    } else {
        // Caso o upload falhe, mantém a imagem anterior
        $local_local01_imagem = $local_local01_imagem_ant;
    }
}

if (alteraLocal01($conexao, $local_local01_titulo, $local_local01_horario, $local_local01_texto, $local_local01_imagem, $local_local01_mapa, $data_local01)) {
    header("Location: personalizar-secao-local01");
    die();
} else { 
    echo "<h1>Algo deu errado:</h1>";
    printf("Erro: %s\n", mysqli_error($conexao));
    exit();
}
?>
