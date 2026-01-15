-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 Oca 2026, 07:40:50
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `cd`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `ad` varchar(50) DEFAULT NULL,
  `soyad` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sifre` varchar(255) DEFAULT NULL,
  `rol` enum('admin') DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `ad`, `soyad`, `email`, `sifre`, `rol`, `created_at`) VALUES
(2, 'Efe', 'Geçkin', 'efegec@outlook.com', '$2y$10$O5CufnSMSqC4f45VTC5anO/EyNENQsmXmgvmRX9h8z8.bZrX.PKLK', 'admin', '2026-01-15 06:33:16');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `randevular`
--

CREATE TABLE `randevular` (
  `id` int(11) NOT NULL,
  `ad` varchar(50) DEFAULT NULL,
  `soyad` varchar(50) DEFAULT NULL,
  `telefon` varchar(15) DEFAULT NULL,
  `tarih` date DEFAULT NULL,
  `saat` time DEFAULT NULL,
  `durum` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `randevular`
--

INSERT INTO `randevular` (`id`, `ad`, `soyad`, `telefon`, `tarih`, `saat`, `durum`, `created_at`) VALUES
(1, 'Efe', 'Geçkin', '05417673471', '2026-01-14', '16:00:00', 1, '2026-01-13 12:49:20'),
(2, 'Ahmet', 'Kaya', '05417673471', '2026-01-14', '16:30:00', 0, '2026-01-13 12:49:54'),
(3, 'Furkan', 'İşler', '05417673471', '2026-01-14', '21:00:00', 0, '2026-01-13 12:50:32'),
(4, 'Kaan', 'Alpkaya', '05417673471', '2026-01-14', '17:00:00', 0, '2026-01-13 12:51:05'),
(6, 'Efe', 'Geçkin', '05417673471', '2026-01-14', '17:30:00', 1, '2026-01-13 13:03:39'),
(7, 'Hatip', 'Karapınar', '05417673471', '2026-01-14', '18:00:00', 0, '2026-01-13 13:44:36'),
(8, 'Kerem', 'Sadıç', '05417673471', '2026-01-15', '10:00:00', 0, '2026-01-13 13:45:00');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `saatler`
--

CREATE TABLE `saatler` (
  `id` int(11) NOT NULL,
  `saat` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `saatler`
--

INSERT INTO `saatler` (`id`, `saat`) VALUES
(1, '10:00:00'),
(2, '10:30:00'),
(3, '11:00:00'),
(4, '11:30:00'),
(5, '12:00:00'),
(6, '12:30:00'),
(7, '13:00:00'),
(8, '13:30:00'),
(9, '14:00:00'),
(10, '14:30:00'),
(11, '15:00:00'),
(12, '15:30:00'),
(13, '16:00:00'),
(14, '16:30:00'),
(15, '17:00:00'),
(16, '17:30:00'),
(17, '18:00:00'),
(18, '18:30:00'),
(19, '19:00:00'),
(20, '19:30:00'),
(21, '20:00:00'),
(22, '20:30:00'),
(23, '21:00:00'),
(24, '21:30:00');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `randevular`
--
ALTER TABLE `randevular`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_randevu` (`tarih`,`saat`,`durum`);

--
-- Tablo için indeksler `saatler`
--
ALTER TABLE `saatler`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `randevular`
--
ALTER TABLE `randevular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `saatler`
--
ALTER TABLE `saatler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
