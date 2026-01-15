<?php
include 'baglan.php';


$ad = isset($_POST['ad']) ? trim($_POST['ad']) : '';
$soyad = isset($_POST['soyad']) ? trim($_POST['soyad']) : '';
$telefon = isset($_POST['telefon']) ? trim($_POST['telefon']) : '';
$tarih = isset($_POST['tarih']) ? trim($_POST['tarih']) : '';
$saat = isset($_POST['saat']) ? trim($_POST['saat']) : '';

// Boş input kontrolü
if ($ad === '' || $soyad === '' || $telefon === '' || $tarih === '' || $saat === '') {
    header("Location: index.php?error=2");
    exit;
}

// Aynı isim ve soyisime sahip ve durumu 0 olan biri varsa eklenmesin
$isimKontrol = $conn->query("SELECT * FROM randevular WHERE ad='$ad' AND soyad='$soyad' AND (durum=0 OR durum IS NULL)");
if ($isimKontrol->num_rows > 0) {
    header("Location: index.php?error=3");
    exit;
}

// Aynı saat dolu mu?
$kontrol = $conn->query("SELECT * FROM randevular WHERE tarih='$tarih' AND saat='$saat'");

if ($kontrol->num_rows > 0) {
    header("Location: index.php?error=4");
} else {
    $ekle = $conn->query("INSERT INTO randevular (ad, soyad, telefon, tarih, saat)
    VALUES ('$ad','$soyad','$telefon','$tarih','$saat')");

    if ($ekle) {
        echo "Randevunuz alındı 👍";
        header("Location: index.php?success=1");
    } else {
        echo "Hata oluştu";
        header("Location: index.php?error=1");
    }
}
