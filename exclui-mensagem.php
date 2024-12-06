<?php 
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';


      
      $id = $_GET["id"];
      
      if(excluiMensagem($conexao,$id))
      {
        header ("Location: mensagens");
        die();
      } elseif(mysqli_errno($conexao)==1451) {
        header ("Location: mensagens?erro=1451");
      } else { 
      ?>
        <h1>Algo deu errado:</h1>
        <?php
          printf("Connect failed: %s\n", mysqli_errno($conexao));
        exit();
      }
      ?>
