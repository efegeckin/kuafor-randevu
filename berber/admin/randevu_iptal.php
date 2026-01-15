<?php
include "../baglan.php";

$id = $_GET['id'];
$conn->query("UPDATE randevular SET durum=1 WHERE id=$id");

header("Location: admin.php");
