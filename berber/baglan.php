<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "cd";

$conn = new mysqli($hostname, $username, $password, $database);

$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

function auth()
{
    session_start();

    if (!isset($_SESSION['admin'])) {
        header("Location: login.php");
        exit;
    }
}
