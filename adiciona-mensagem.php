<?php 
require_once 'logica-usuario.php';
require_once 'conecta.php';
require_once 'banco-meusite.php';

      $nome = $_POST["nome"];
      $data = date('y/m/d');
      $mensagem = $_POST["mensagem"];
      $telefone = $_POST["telefone"];

      if(insereMensagem($conexao,$nome, $data, $mensagem, $telefone))
      {
           $email_data = [
        'nome' => $nome,
        'telefone' => $telefone,
        'mensagem' => $mensagem,
    ];
    $email_data_json = escapeshellarg(json_encode($email_data));

    // Executando o script de envio de e-mail em segundo plano e salvando logs
    shell_exec("php email3.php $email_data_json > /dev/null 2>&1 &");
        header ("Location: index?mensagem=true#mensagens");
        die();
      }else{ 
      ?>
        <h1>Algo deu errado:</h1>
        <?php
          printf("Connect failed: %s\n", mysqli_error($conexao));
        exit();
      }
      ?>

