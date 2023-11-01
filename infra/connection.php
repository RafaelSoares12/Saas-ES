<?php
$servername = "localhost";
$username = "rafael";
$password = "password";
$dbname = "saasEs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
