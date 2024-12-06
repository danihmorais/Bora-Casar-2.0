<?php 
require_once 'logica-usuario.php';
verificaUsuario(); verificaAdmin();
require_once 'conecta.php';
require_once 'banco-meusite.php';

      
      $id = $_GET["id"];
      $confirmacao = false;
      $nome_pessoa = "";
      $telefone = "";
      
      if(confirmaPresente($conexao, $id, $confirmacao, $nome_pessoa, $telefone))
      {
        header ("Location: presentes");
        die();
      }else{ 
      ?>
        <h1>Algo deu errado:</h1>
        <?php
          printf("Connect failed: %s\n", mysqli_error($conexao));
        exit();
      }
      ?>