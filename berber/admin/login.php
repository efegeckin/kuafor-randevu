<?php
session_start();
include "../baglan.php";


if ($_POST) {
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    $sorgu = $conn->query("SELECT * FROM kullanicilar WHERE email='$email'");

    if ($sorgu->num_rows == 1) {
        $kullanici = $sorgu->fetch_assoc();

        if (password_verify($sifre, $kullanici['sifre'])) {
            $_SESSION['admin'] = $kullanici['id'];
            header("Location: admin.php");
            exit();
        } else {
            echo "Şifre yanlış";
        }
    } else {
        echo "Kullanıcı bulunamadı";
    }
}
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
</head>

<body>
    <div class="container">
        <form method="POST" style="max-width: 400px;" class="card p-4 col-md-4 mx-auto mt-5">
            <div class="d-flex justify-content-center align-items-center gap-2 mb-4">
                <img style="max-width: 50px;" src="../assets/images/site-icon_black.png" alt="">
                <h4 class="text-center mb-0">Admin Giriş</h4>
            </div>


            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
            <input type="password" name="sifre" class="form-control mb-3" placeholder="Şifre" required>

            <button class="btn btn-dark w-100">Giriş Yap</button>
        </form>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>