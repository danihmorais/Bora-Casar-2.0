<?php 
require_once 'logica-usuario.php';
require_once 'conecta.php';
require_once 'banco-meusite.php';

      $data = date('Y-m-d');
      $nome = $_POST["nome"];
        
      $recebe_valor = $_POST["valor"];
      $valor = str_replace(".", "", $recebe_valor);
      $valor = str_replace(",", ".", $valor);
      $telefone = $_POST["telefone"];
      
      if(insereTransferencia($conexao, $nome, $valor, $telefone, $data))
      {
         $email_data = [
        'nome' => $nome,
        'telefone' => $telefone,
        'valor' => $valor,
    ];
    $email_data_json = escapeshellarg(json_encode($email_data));

    // Executando o script de envio de e-mail em segundo plano e salvando logs
    shell_exec("php email2.php $email_data_json > /dev/null 2>&1 &");
        header ("Location: lista-presentes");
        die();
      }else{ 
      ?>
        <h1>Algo deu errado:</h1>
        <?php
          printf("Connect failed: %s\n", mysqli_error($conexao));
        exit();
      }
      ?>

