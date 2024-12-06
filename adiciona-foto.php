<?php 
require_once 'logica-usuario.php';
verificaUsuario();
verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

$nova_foto_tmp = $_FILES['nova_foto']['tmp_name'];
$nome = $_FILES['nova_foto']['name'];

$extensao = pathinfo($nome, PATHINFO_EXTENSION);
$extensao = strtolower($extensao);

    
$nova_foto = uniqid(time()) . '.' . $extensao;

$destino = 'upload/fotos/' . $nova_foto;
if ( @move_uploaded_file ( $nova_foto_tmp, $destino ) ) {
     
if (insereFoto($conexao, $nova_foto)) {
                header("Location: fotos");
                die();
            } else {
                printf("Erro na conexão: %s\n", mysqli_error($conexao));
                exit();
}
}
?>
