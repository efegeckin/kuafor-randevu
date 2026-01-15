<?php
include "../baglan.php";
header('Content-Type: application/json');

$tarih = isset($_GET['tarih']) ? $_GET['tarih'] : '';
$where = '';
if ($tarih) {
    $where = "WHERE tarih = '" . $conn->real_escape_string($tarih) . "'";
}
$sql = "SELECT * FROM randevular $where ORDER BY saat";
$result = $conn->query($sql);

$data = [];
while ($r = $result->fetch_assoc()) {
    $data[] = $r;
}
echo json_encode($data);
