<?php 
require_once 'logica-usuario.php';
verificaUsuario(); 
verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

$noiva_img_ant = $_POST['noiva_img_anterior'];  
$noiva_nome = $_POST["noiva_nome"];
$noiva_desc = $_POST["noiva_desc"];
$diretorio = "upload/"; // Define o diretório para onde enviaremos o arquivo
$noiva_img = $noiva_img_ant; // Define como padrão a imagem anterior

if ($_FILES['noiva_img']['name'] != "") {
    $extensao = strtolower(substr($_FILES['noiva_img']['name'], -4)); // Pega a extensão do arquivo
    $noiva_img = uniqid(time()) . $extensao; // Define o nome único do arquivo
    
    if (move_uploaded_file($_FILES['noiva_img']['tmp_name'], $diretorio . $noiva_img)) { // Efetua o upload
        if (file_exists($diretorio . $noiva_img_ant)) { // Verifica se a imagem anterior existe no diretório correto
            unlink($diretorio . $noiva_img_ant); // Remove o arquivo antigo, se existir
        }
    } else {
        $noiva_img = $noiva_img_ant; // Se o upload falhar, mantém a imagem anterior
    }
}

if (alteraBoasVindasNoiva($conexao, $noiva_nome, $noiva_desc, $noiva_img)) {
    header("Location: personalizar-secao-boas-vindas-noiva");
    die();
} else { 
    echo "<h1>Algo deu errado:</h1>";
    printf("Erro: %s\n", mysqli_error($conexao));
    exit();
}
?>
