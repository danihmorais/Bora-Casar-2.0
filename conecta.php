<?php
// Database connection details
$servername = "localhost";
$database = "meusite";  // Replace with your actual database name
$username = "root";  // Default username for local MySQL databases
$password = "123456";  // Default password (if any)

// Email settings

$email_host = "smtp.hostinger.com";
$email_user = "seudominio@dominio";
$email_pass = "12345678";
$email_port = "587";
$email_destinatario = "seuemailparticular@email.com";
$email_destinatario2 = "seuemailparticular2@email.com";
// Create the connection
$conexao = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conexao) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
