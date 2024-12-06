<?php
require_once 'conecta.php';
require_once 'banco-meusite.php';
$data = date('Y-m-d');

// Obtendo os dados do formulário
$id = $_POST["id"]; 
$nome_pessoa = $_POST["nome_pessoa"];
$telefone = $_POST["telefone"];
$confirmacao = true;


if (confirmadorPresente($conexao, $id, $nome_pessoa, $telefone, $confirmacao, $data)) {
     $email_data = [
        'id' => $id,
        'nome_pessoa' => $nome_pessoa,
        'telefone' => $telefone,
    ];
    $email_data_json = escapeshellarg(json_encode($email_data));

    // Executando o script de envio de e-mail em segundo plano e salvando logs
    shell_exec("php email.php $email_data_json > /dev/null 2>&1 &");
} else {
    // Caso a confirmação não seja bem-sucedida
    echo "<h1>Algo deu errado:</h1>";
    printf("Erro na conexão: %s\n", mysqli_error($conexao)); // Exibe erro de conexão
    exit();
}
?>