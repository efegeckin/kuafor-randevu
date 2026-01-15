<?php
//Silme işlemi
include '../baglan.php';
$randevu_id = $_GET['id'];
$sil = $conn->query("DELETE FROM randevular WHERE id='$randevu_id'");
if ($sil) {
    header("Location: admin.php");
} else {
    echo "Hata oluştu";
}
