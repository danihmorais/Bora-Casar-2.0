<?php 
require_once 'logica-usuario.php';
verificaUsuario(); 
verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

$noivo_img_ant = $_POST['noivo_img_anterior'];  
$noivo_nome = $_POST["noivo_nome"];
$noivo_desc = $_POST["noivo_desc"];
$diretorio = "upload/"; // Define o diretório para onde enviaremos o arquivo
$noivo_img = $noivo_img_ant; // Define como padrão a imagem anterior

if ($_FILES['noivo_img']['name'] != "") {
    $extensao = strtolower(substr($_FILES['noivo_img']['name'], -4)); // Pega a extensão do arquivo
    $noivo_img = uniqid(time()) . $extensao; // Define o nome único do arquivo
    
    if (move_uploaded_file($_FILES['noivo_img']['tmp_name'], $diretorio . $noivo_img)) { // Efetua o upload
        if (file_exists($diretorio . $noivo_img_ant)) { // Verifica se a imagem anterior existe no diretório correto
            unlink($diretorio . $noivo_img_ant); // Remove o arquivo antigo, se existir
        }
    } else {
        $noivo_img = $noivo_img_ant; // Se o upload falhar, mantém a imagem anterior
    }
}

if (alteraBoasVindasNoivo($conexao, $noivo_nome, $noivo_desc, $noivo_img)) {
    header("Location: personalizar-secao-boas-vindas-noivo");
    die();
} else { 
    echo "<h1>Algo deu errado:</h1>";
    printf("Erro: %s\n", mysqli_error($conexao));
    exit();
}
?>
