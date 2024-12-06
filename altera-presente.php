<?php
require_once ('logica-usuario.php');
require_once ('conecta.php');
require_once ('banco-meusite.php');
require_once ('class/Presente.php');

$presente = new Presente();
$presente->id = $_GET["id"];
$presente->titulo = $_POST["titulo"];
$recebe_valor = $_POST["valor"];
$valor = str_replace(".", "", $recebe_valor);
$valor = str_replace(",", ".", $valor);
$presente->valor = $valor;
$presente->link = $_POST["link"];
$presente->categoria = $_POST["categoria"];

// Verifica se uma nova imagem foi enviada
if (isset($_FILES['presente_imagem']) && $_FILES['presente_imagem']['error'] == UPLOAD_ERR_OK) {
    $produto_imagem_tmp = $_FILES['presente_imagem']['tmp_name'];
    $nome = $_FILES['presente_imagem']['name'];

    // Pega a extensão
    $extensao = pathinfo($nome, PATHINFO_EXTENSION);
    $extensao = strtolower($extensao);

 
        $presente->imagem = uniqid(time()) . '.' . $extensao;
        $destino = 'upload/presentes/' . $presente->imagem;

        // Move o arquivo para o destino
        if (@move_uploaded_file($produto_imagem_tmp, $destino)) {
            $presente_imagem_anterior = 'upload/presentes/' . $_POST["presente_imagem_anterior"];
            if (file_exists($presente_imagem_anterior)) {
            unlink($presente_imagem_anterior);
                }
            // A nova imagem foi salva com sucesso
            echo 'Imagem do produto salva com sucesso em: <strong>' . $destino . '</strong><br />';
        }
} else {
    // Se nenhuma nova imagem foi enviada, mantenha a imagem antiga
    $presente->imagem = $_POST["presente_imagem_anterior"];
}

// Atualiza o presente no banco de dados
if (alteraPresente($conexao, $presente)) {
    header("Location: presentes?cadastro=true");
    die();
} else {
    echo '<h1>Algo deu errado:</h1>';
    printf("Connect failed: %s\n", mysqli_error($conexao));
    exit();
}
?>
