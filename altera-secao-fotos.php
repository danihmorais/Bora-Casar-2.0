<?php 
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';


      $fotos_titulo = $_POST["fotos_titulo"];
      $fotos_subtitulo = $_POST["fotos_subtitulo"];

      if(alteraSecaoFotos(
        $conexao,
        $fotos_titulo,
        $fotos_subtitulo
        ))
      {
        header ("Location: personalizar-secao-fotos");
        die();
      }else{ 
      ?>
        <h1>Algo deu errado:</h1>
        <?php
          printf("Connect failed: %s\n", mysqli_error($conexao));
        exit();
      }
      ?>