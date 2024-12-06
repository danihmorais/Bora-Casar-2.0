<?php
require_once 'conecta.php'; // Certifique-se de que esta conexão está funcionando corretamente
require_once 'banco-meusite.php';
require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Obter dados do argumento passado
if ($argc > 1) {
    $data = json_decode($argv[1], true); // Decodifica os dados JSON
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("Erro ao decodificar JSON: " . json_last_error_msg());
        exit();
    }
} else {
    error_log("Nenhum dado foi passado para o script.");
    exit();
}

// Definir as variáveis
$id = $data['id'];
$nome_pessoa = $data['nome_pessoa'];
$telefone = $data['telefone'];


// Função genérica para enviar e-mail
function enviarEmail($assunto, $mensagem, $email_host, $email_user, $email_pass, $email_port, $email_destinatario, $email_destinatario2, $caminho_imagem) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = $email_host;
        $mail->SMTPAuth = true;
        $mail->Username = $email_user;
        $mail->Password = $email_pass;
        $mail->SMTPSecure = 'tls';
        $mail->Port = $email_port;

        $mail->setFrom($email_user); // Nome do domínio adicionado

        $mail->addAddress($email_destinatario);
        $mail->addAddress($email_destinatario2);

        // Define a codificação correta
        $mail->CharSet = 'UTF-8'; // Define a codificação como UTF-8
        $mail->Encoding = 'base64'; // Garante que o conteúdo seja enviado corretamente

        // Adicionar imagem embutida
        if (file_exists($caminho_imagem)) {
            $cid = $mail->addEmbeddedImage($caminho_imagem, 'imagem_cid', 'imagem.jpg');
        } else {
            error_log("Imagem não encontrada: " . $caminho_imagem);
        }

        // Definir o corpo como HTML
        $mail->isHTML(true); // Torna o corpo do e-mail em HTML
        $mail->Subject = $assunto;
        $mail->Body = $mensagem;
        $mail->SMTPDebug = 0;
        $mail->send();

    } catch (Exception $e) {
        error_log("Erro ao enviar email: " . $mail->ErrorInfo);
    }
}


// Usar a função listaPresente já existente
$presentes = listaPresente2($conexao, $id);
$presente = $presentes[0];

if (!empty($presentes)) {
    // Caminho da imagem
    $caminho_imagem = __DIR__ . "/upload/presentes/" . $presente->imagem;
    
// Formatar valor
$valor_formatado = "R$ " . number_format($presente->valor, 2, ',', '.');

// Criar o link para o WhatsApp
$telefone_link = "https://wa.me/" . preg_replace('/[^0-9]/', '', $telefone); // Remove qualquer caractere não numérico do telefone

// Construção da mensagem com a imagem embutida no corpo
$mensagem = "<p style='text-align: justify;'><strong>Parabéns! Informaram que irão dar o seguinte presente:</strong></p>";
$mensagem .= "<p style='text-align: justify;'><strong>Nome:</strong> $nome_pessoa</p>";
$mensagem .= "<p style='text-align: justify;'><strong>Telefone:</strong> <a href='$telefone_link' target='_blank'>$telefone</a></p>";
$mensagem .= "<p style='text-align: justify;'><strong>Titulo:</strong> " . $presente->titulo . "</p>";
$mensagem .= "<p style='text-align: justify;'><strong>Valor:</strong> $valor_formatado</p>";
$mensagem .= "<p style='text-align: justify;'><strong>Link:</strong> <a href='" . $presente->link . "'>" . $presente->link . "</a></p>";

// Inserir a imagem no corpo do e-mail
$mensagem .= "<p style='text-align: justify;'><img src='cid:imagem_cid' alt='Imagem do Presente' style='width:200px;'></p>";

} else {
    // Caso não tenha encontrado dados
    $mensagem = "Não foram encontrados detalhes para o ID $id.\n";
}

// Enviar e-mail com a mensagem gerada
enviarEmail("Presente recebido!", $mensagem, $email_host, $email_user, $email_pass, $email_port, $email_destinatario, $email_destinatario2, $caminho_imagem);
?>
