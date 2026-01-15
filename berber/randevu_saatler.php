<?php
include 'baglan.php';
header('Content-Type: application/json');

$tarih = isset($_GET['tarih']) ? $_GET['tarih'] : '';
if (!$tarih) {
    echo json_encode([]);
    exit;
}

// O tarihte alınmış saatleri bul
$alinanSaatler = [];
$sql = "SELECT saat FROM randevular WHERE tarih = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $tarih);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $alinanSaatler[] = substr($row['saat'], 0, 5);
}
$stmt->close();

// Tüm saatleri çek
$saatler = $conn->query("SELECT saat FROM saatler ORDER BY id ASC");
$saatler_array = [];
while ($row = $saatler->fetch_assoc()) {
    $saat = substr($row['saat'], 0, 5);
    $saatler_array[] = [
        'saat' => $saat,
        'disabled' => in_array($saat, $alinanSaatler)
    ];
}

echo json_encode($saatler_array);
