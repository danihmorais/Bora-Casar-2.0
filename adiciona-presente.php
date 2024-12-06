<?php 
require_once ('logica-usuario.php');
require_once ('conecta.php');
require_once ('banco-meusite.php');
require_once ('class/Presente.php');

$presente = new Presente();

$presente->titulo = $_POST["titulo"];
$recebe_valor = $_POST["valor"];
$valor = str_replace(".", "", $recebe_valor);
$valor = str_replace(",", ".", $valor);
$presente->valor = $valor;
$presente->link = $_POST["link"];
$presente->categoria = $_POST["codCategoria"];



  $produto_imagem_tmp = $_FILES[ 'imagem' ][ 'tmp_name' ];
  $nome = $_FILES[ 'imagem' ][ 'name' ];

  // Pega a extensão
  $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );

  // Converte a extensão para minúsculo
  $extensao = strtolower ( $extensao );

      $presente->imagem = uniqid ( time () ) . '.' . $extensao;

      // Concatena a pasta com o nome
      $destino = 'upload/presentes/' . $presente->imagem;

      // tenta mover o nova_foto para o destino
      if ( @move_uploaded_file ( $produto_imagem_tmp, $destino ) ) {
        
      
        if(inserePresente($conexao, $presente)) {
          header ("Location: presentes");
          die();
        }else{ 
          ?>
          <h1>Algo deu errado:</h1>
          <?php
          printf("Connect failed: %s\n", mysqli_error($conexao));
          exit();
        }

      }
else
  header ("Location: presentes?status=erro");  
?>