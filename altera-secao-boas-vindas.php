<?php 
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';


      $section01_titulo = $_POST["section01_titulo"];
      $section01_subtitulo = $_POST["section01_subtitulo"];
      $section01_texto = $_POST["section01_texto"];
      
      if(alteraSecaoBoasVindas($conexao,
      $section01_titulo,
      $section01_subtitulo,
      $section01_texto
      ))
      {
        header ("Location: personalizar-secao-boas-vindas");
        die();
      }else{ 
      ?>
        <h1>Algo deu errado:</h1>
        <?php
          printf("Connect failed: %s\n", mysqli_error($conexao));
        exit();
      }
      ?>
