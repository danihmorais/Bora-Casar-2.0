<?php 
require_once 'logica-usuario.php';
verificaUsuario();
verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

$texto_presente = $_POST["texto_presente"];

if (insereTextoPresente($conexao, $texto_presente)){ 
        header ("Location: personalizar-texto-presente");
        die();
      }else{ 
      ?>
        <h1>Algo deu errado:</h1>
        <?php
          printf("Connect failed: %s\n", mysqli_error($conexao));
        exit();
      }
      ?>
