<?php
include "baglan.php";

$tarih = $_GET['tarih'];

// TÜM SAATLER
$saatler = $conn->query("SELECT saat FROM saatler ORDER BY saat");

// DOLU SAATLER (aktif)
$dolu = $conn->query("
    SELECT saat FROM randevular 
    WHERE tarih='$tarih' AND durum=0
");

$doluSaatler = [];
while ($d = $dolu->fetch_assoc()) {
    $doluSaatler[] = substr($d['saat'], 0, 5);
}

// ÇIKIŞ
$sonuc = [];
while ($s = $saatler->fetch_assoc()) {
    $saat = substr($s['saat'], 0, 5);
    $sonuc[] = [
        "saat" => $saat,
        "dolu" => in_array($saat, $doluSaatler)
    ];
}

echo json_encode($sonuc);
