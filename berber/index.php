<?php
include 'baglan.php';

$saatler = $conn->query("SELECT * FROM saatler ORDER BY id ASC");
$saatler_array = [];
if ($saatler) {
    while ($row = $saatler->fetch_assoc()) {
        $saatler_array[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Berber Randevu Sistemi</title>
    <?php include 'includes/link.php'; ?>

    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        .saat {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .saat-item {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            max-width: 120px;
            width: 100%;
            gap: 8px;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            user-select: none;
        }

        .saat-item:hover {
            background-color: #ffc107;
            color: #fff;
        }

        .btn-check:checked+label.saat-item {
            background-color: #ffc107;
            color: #fff;
            border-color: #ffc107;
        }

        .btn-check:disabled+label.saat-item {
            background-color: #e9ecef;
            color: #6c757d;
            border-color: #dee2e6;
            cursor: not-allowed;
        }

        /* Responsive düzenlemeler */
        @media (max-width: 991px) {

            .col-lg-4,
            .col-lg-8 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .row.g-4 {
                flex-direction: column;
            }
        }

        @media (max-width: 768px) {
            .container.py-5 {
                padding: 1rem 0 !important;
            }

            .card {
                margin-bottom: 18px;
            }

            .saat {
                gap: 6px;
            }

            .saat-item {
                max-width: 100%;
                font-size: 15px;
                padding: 8px 8px;
            }

            h1 {
                font-size: 1.3rem;
            }

            .panel {
                position: static !important;
                margin: 0 !important;
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 576px) {
            .row.g-4 {
                gap: 10px !important;
            }

            .card {
                padding: 10px !important;
            }

            .saat-item {
                font-size: 14px;
                padding: 7px 4px;
            }

            .alert {
                left: 0;
                right: 0;
                margin: 0.5rem auto !important;
                width: 95vw;
            }
        }
    </style>
</head>

<body class="position-relative vh-100">
    <!-- Başarılı Randevu Mesajı -->
    <?php if (isset($_GET['success']) && $_GET['success'] == '1'): ?>
        <div class="alert alert-success alert-dismissible fade show position-absolute bottom-0 end-0 m-3" role="alert">
            <i class="fa-solid fa-check-circle"></i> Randevunuz başarıyla alındı!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Hatalı Randevu Mesajı -->
    <?php if (isset($_GET['error']) && $_GET['error'] == '1'): ?>
        <div class="alert alert-danger alert-dismissible fade show position-absolute bottom-0 end-0 m-3" role="alert">
            <i class="fa-solid fa-exclamation-circle"></i> Randevu alınırken bir hata oluştu!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['error']) && $_GET['error'] == '2'): ?>
        <div class="alert alert-danger alert-dismissible fade show position-absolute bottom-0 end-0 m-3" role="alert">
            <i class="fa-solid fa-exclamation-circle"></i> Lütfen tüm alanları doldurun!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['error']) && $_GET['error'] == '3'): ?>
        <div class="alert alert-danger alert-dismissible fade show position-absolute bottom-0 end-0 m-3" role="alert">
            <i class="fa-solid fa-exclamation-circle"></i> Aynı isim ve soyisime sahip biri zaten kayıtlı!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['error']) && $_GET['error'] == '4'): ?>
        <div class="alert alert-danger alert-dismissible fade show position-absolute bottom-0 end-0 m-3" role="alert">
            <i class="fa-solid fa-exclamation-circle"></i> Bu saat dolu!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="container position-relative py-5">



        <!-- Başlık -->
        <div class="text-center mb-5 animate__animated animate__fadeInDown">
            <h1 class="fw-bold">
                <img src="assets/images/site-icon.png" style="max-width: 80px;" alt=""> Berber Randevu Sistemi
            </h1>
            <p class="text-white">Profesyonel & Hızlı Randevu</p>
        </div>
        <form action="randevu_kaydet.php" method="POST">
            <div class="row g-4">

                <!-- Form -->
                <div class="col-lg-4 animate__animated animate__fadeInLeft">
                    <div class="randevu_form card p-4 text-dark">
                        <h4 class="text-center mb-3">
                            <i class="fa-solid fa-calendar-check text-warning"></i> Randevu Al
                        </h4>


                        <input type="text" class="form-control mb-3" placeholder="Ad" name="ad" id="ad">
                        <input type="text" class="form-control mb-3" placeholder="Soyad" name="soyad" id="soyad">
                        <input type="tel" class="form-control mb-3" placeholder="Telefon" name="telefon" id="telefon">

                        <?php
                        $today = date('Y-m-d');
                        $maxDate = date('Y-m-d', strtotime('+14 days'));
                        ?>
                        <input type="date" class="form-control mb-3" name="tarih" min="<?= $today ?>" max="<?= $maxDate ?>" id="tarih">

                        <button class="btn btn-custom w-100" type="submit">
                            <i class="fa-solid fa-check"></i> Randevu Al
                        </button>

                    </div>
                </div>

                <!-- Bilgi Alanı -->
                <div class="col-lg-8 animate__animated animate__fadeInRight">
                    <div class="card p-4">
                        <div class="row">
                            <div class="col-6">
                                <h4>
                                    <i class="fa-solid fa-info-circle text-warning"></i> Neden Bizi Seçmelisiniz?
                                </h4>
                                <ul class="mt-3">
                                    <li>💈 Profesyonel Berber Kadrosu</li>
                                    <li>⏱️ Dakik & Hızlı Hizmet</li>
                                    <li>📱 Online Randevu Kolaylığı</li>
                                    <li>⭐ Müşteri Memnuniyeti</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <h4>
                                    <i class="fa-solid fa-clock text-warning"></i> Çalışma Saatlerimiz
                                </h4>
                                <ul class="mt-3">
                                    <li>📅 Pazartesi - Cuma: 10:00 - 22:00</li>
                                    <li>📅 Cumartesi: 10:00 - 22:00</li>
                                    <li>🚫 Pazar: Kapalı</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div id="saat-card" class="card p-4 mt-2" style="display:none;">
                        <h4>
                            <i class="fa-solid fa-clock text-warning"></i> Saat Seçiniz
                        </h4>
                        <div class="saat animate__animated animate__fadeInRight" id="saatler-container">
                            <!-- Saatler buraya gelecek -->
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="panel position-absolute top-0 end-0 m-3">
            <a href="admin/login.php" target="_blank" rel="noopener noreferrer">
                <button class="btn btn-outline-warning">
                    <i class="fa-solid fa-user-shield"></i> Admin Panel
                </button>
            </a>
        </div>
    </div>

    <script>
        // Pazar günlerini devre dışı bırak
        document.addEventListener('DOMContentLoaded', function() {
            var tarihInput = document.getElementById('tarih');
            tarihInput.addEventListener('input', function() {
                var secilen = new Date(this.value);
                if (secilen.getDay() === 0) { // 0 = Pazar
                    alert('Pazar günü seçilemez!');
                    this.value = '';
                }
                checkInputsAndLoadSaatler();
            });

            document.getElementById('ad').addEventListener('input', checkInputsAndLoadSaatler);
            document.getElementById('soyad').addEventListener('input', checkInputsAndLoadSaatler);
            document.getElementById('telefon').addEventListener('input', checkInputsAndLoadSaatler);
        });

        function checkInputsAndLoadSaatler() {
            var ad = document.getElementById('ad').value.trim();
            var soyad = document.getElementById('soyad').value.trim();
            var telefon = document.getElementById('telefon').value.trim();
            var tarih = document.getElementById('tarih').value;
            var saatCard = document.getElementById('saat-card');
            var saatlerContainer = document.getElementById('saatler-container');

            if (ad && soyad && telefon && tarih) {
                // Saatleri yükle
                fetch('randevu_saatler.php?tarih=' + tarih)
                    .then(response => response.json())
                    .then(data => {
                        saatlerContainer.innerHTML = '';
                        data.forEach(function(item, idx) {
                            var inputId = 'option' + item.saat.replace(':', '');
                            var input = document.createElement('input');
                            input.type = 'radio';
                            input.className = 'btn-check';
                            input.name = 'saat';
                            input.id = inputId;
                            input.value = item.saat;
                            if (item.disabled) input.disabled = true;
                            if (idx === 0 && !item.disabled) input.checked = true;

                            var label = document.createElement('label');
                            label.className = 'saat-item';
                            label.htmlFor = inputId;
                            label.innerHTML = '<i class="fa-solid fa-clock"></i> ' + item.saat;

                            saatlerContainer.appendChild(input);
                            saatlerContainer.appendChild(label);
                        });
                        saatCard.style.display = 'block';
                    });
            } else {
                saatlerContainer.innerHTML = '';
                saatCard.style.display = 'none';
            }
        }
    </script>
    <?php include 'includes/foot.php'; ?>
</body>

</html>