<?php 
require_once 'logica-usuario.php';
verificaUsuario(); 
verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

$local_local02_titulo = $_POST["local_local02_titulo"];
$local_local02_horario = $_POST["local_local02_horario"];
$local_local02_texto = $_POST["local_local02_texto"];
$local_local02_mapa = $_POST["local_local02_mapa"];
$local_local02_imagem_ant = $_POST['local_local02_imagem_anterior'];
$diretorio = "upload/"; // Define o diretório para upload
$data_local02 = $_POST["data_local02"];

// Define o nome da imagem como a imagem anterior por padrão
$local_local02_imagem = $local_local02_imagem_ant;

if ($_FILES['local_local02_imagem']['name'] != "") {
    $extensao = strtolower(substr($_FILES['local_local02_imagem']['name'], -4)); // Pega a extensão do arquivo
    $local_local02_imagem = uniqid(time()) . $extensao; // Define o nome único do arquivo

    if (move_uploaded_file($_FILES['local_local02_imagem']['tmp_name'], $diretorio . $local_local02_imagem)) { // Efetua o upload
        if (file_exists($diretorio . $local_local02_imagem_ant)) { // Verifica se a imagem anterior existe
            unlink($diretorio . $local_local02_imagem_ant); // Remove a imagem antiga
        }
    } else {
        // Caso o upload falhe, mantém a imagem anterior
        $local_local02_imagem = $local_local02_imagem_ant;
    }
}

if (alteraLocal02($conexao, $local_local02_titulo, $local_local02_horario, $local_local02_texto, $local_local02_imagem, $local_local02_mapa, $data_local02)) {
    header("Location: personalizar-secao-local02");
    die();
} else { 
    echo "<h1>Algo deu errado:</h1>";
    printf("Erro: %s\n", mysqli_error($conexao));
    exit();
}
?>
