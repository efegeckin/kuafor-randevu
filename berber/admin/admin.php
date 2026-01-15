<?php
include "../baglan.php";
$randevular = $conn->query("SELECT * FROM randevular ORDER BY tarih, saat");
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        /* Görünüm butonları mobilde alt alta gelsin */
        @media (max-width: 576px) {
            .card-header .d-flex.align-items-center.gap-2 {
                flex-direction: column;
                align-items: stretch !important;
                gap: 8px !important;
            }

            .card-header>div:last-child {
                margin-top: 10px;
                width: 100%;
                display: flex;
                gap: 8px;
                justify-content: flex-start;
            }

            .card-header label,
            .card-header input,
            .card-header button {
                width: 100%;
                min-width: 0;
            }
        }

        /* Kartlar mobilde tam genişlikte olsun */
        @media (max-width: 576px) {
            #randevu-grid .col {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        /* Tablo responsive: hücreler küçük ekranda blok gibi */
        @media (max-width: 768px) {
            .table-responsive table {
                font-size: 13px;
            }

            .table-responsive th,
            .table-responsive td {
                padding: 8px 6px;
            }
        }
    </style>
</head>

<body>
    <div class="container position-relative py-5">
        <div class="card mx-auto mt-5" style="max-width: 1200px;">
            <div class="card-header d-flex flex-wrap align-items-center gap-3 justify-content-between">
                <h3 class="header-title m-0">
                    <i class="fa-solid fa-list"></i> Randevu Listesi
                </h3>
                <div class="d-flex align-items-center gap-2">
                    <label for="tarihSec" class="mb-0 fw-semibold">Tarih:</label>
                    <input type="date" id="tarihSec" class="form-control" style="max-width: 180px;">

                    <button class="btn btn-secondary btn-sm" id="temizleBtn">Tümü</button>

                </div>
                <div>
                    <button id="showTable" class="btn btn-light btn-sm" type="button"><i class="fa-solid fa-table"></i> Tablo</button>
                    <button id="showGrid" class="btn btn-outline-light btn-sm" type="button"><i class="fa-solid fa-th"></i> Kart</button>
                </div>
            </div>
            <div class="card-body">
                <div id="tableView">
                    <div class="table-responsive">
                        <table class="table table-bordered align-center" id="randevu-table">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Ad Soyad</th>
                                    <th>Telefon</th>
                                    <th>Tarih</th>
                                    <th>Saat</th>
                                    <th>Durum</th>
                                    <th>İşlem</th>
                                </tr>
                            </thead>
                            <tbody id="randevu-tbody">
                                <!-- JS ile doldurulacak -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="gridView" style="display:none;">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="randevu-grid">
                        <!-- JS ile kartlar buraya gelecek -->
                    </div>
                </div>
            </div>
        </div>
        <div class="panel position-absolute top-0 end-0 m-3">
            <a href="../index.php" target="_blank" rel="noopener noreferrer">
                <button class="btn btn-outline-warning">
                    <i class="fa-solid fa-house"></i> Ana Sayfa
                </button>
            </a>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function fetchRandevular(tarih = '') {
            let url = 'admin_randevu_liste.php';
            if (tarih) url += '?tarih=' + encodeURIComponent(tarih);
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    // Kart grid
                    const grid = document.getElementById('randevu-grid');
                    grid.innerHTML = '';
                    // Tablo
                    const tbody = document.getElementById('randevu-tbody');
                    tbody.innerHTML = '';
                    if (data.length === 0) {
                        grid.innerHTML = `<div class='col'><div class='alert alert-info text-center'>Henüz randevu yok.</div></div>`;
                        tbody.innerHTML = `<tr><td colspan='7' class='text-center'>Henüz randevu yok.</td></tr>`;
                        return;
                    }
                    data.forEach(r => {
                        let durum = r.durum == 0 ?
                            '<span class="badge bg-success">Aktif</span>' :
                            '<span class="badge bg-danger">İptal</span>';
                        let islem = `<a href="randevu_sil.php?id=${r.id}" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>`;
                        if (r.durum == 0) {
                            islem += ` <a href="randevu_iptal.php?id=${r.id}" class="btn btn-warning btn-sm"><i class="fa-solid fa-ban"></i></a>`;
                        }
                        // Kart
                        grid.innerHTML += `
                            <div class="col">
                                <div class="card h-100 shadow-sm border-${r.durum == 0 ? 'success' : 'danger'}">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            ${durum}
                                            <span class="fw-bold text-secondary">#${r.id}</span>
                                        </div>
                                        <h5 class="card-title mb-1"><i class="fa-solid fa-user"></i> ${r.ad} ${r.soyad}</h5>
                                        <p class="mb-1"><i class="fa-solid fa-phone"></i> ${r.telefon}</p>
                                        <p class="mb-1"><i class="fa-solid fa-calendar"></i> ${r.tarih}</p>
                                        <p class="mb-2"><i class="fa-solid fa-clock"></i> ${r.saat}</p>
                                    </div>
                                    <div class="card-footer bg-transparent border-0 d-flex gap-2 justify-content-end">
                                        ${islem}
                                    </div>
                                </div>
                            </div>
                        `;
                        // Tablo
                        tbody.innerHTML += `
                            <tr>
                                <td>${r.id}</td>
                                <td>${r.ad} ${r.soyad}</td>
                                <td>${r.telefon}</td>
                                <td>${r.tarih}</td>
                                <td>${r.saat}</td>
                                <td>${durum}</td>
                                <td class="d-flex justify-content-center align-items-start gap-2">${islem}</td>
                            </tr>
                        `;
                    });
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchRandevular();
            document.getElementById('tarihSec').addEventListener('change', function() {
                fetchRandevular(this.value);
            });
            document.getElementById('temizleBtn').addEventListener('click', function() {
                document.getElementById('tarihSec').value = '';
                fetchRandevular();
            });
            // Görünüm seçimi
            document.getElementById('tableView').style.display = '';
            document.getElementById('gridView').style.display = 'none';
            document.getElementById('showTable').addEventListener('click', function() {
                document.getElementById('tableView').style.display = '';
                document.getElementById('gridView').style.display = 'none';
                this.classList.replace('btn-outline-light', 'btn-light');
                document.getElementById('showGrid').classList.replace('btn-light', 'btn-outline-light');
            });
            document.getElementById('showGrid').addEventListener('click', function() {
                document.getElementById('tableView').style.display = 'none';
                document.getElementById('gridView').style.display = '';
                this.classList.replace('btn-outline-light', 'btn-light');
                document.getElementById('showTable').classList.replace('btn-light', 'btn-outline-light');
            });
        });
    </script>
</body>

</html>