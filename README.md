# Canlı İncelemek İçin https://www.berber.efegeckin.com.tr/

------------------------------------------------------------------------

# PHP Berber Randevu Sistemi

PHP kullanılarak geliştirilmiş, berberler için **randevu yönetimini
kolaylaştıran** bir web uygulamasıdır.\
Kullanıcılar belirli kurallar dahilinde randevu oluşturabilir, berberler
ise admin paneli üzerinden randevuları görüntüleyip yönetebilir.

------------------------------------------------------------------------

## 🚀 Proje Özeti

Bu proje, bir berber salonunun randevu süreçlerini dijital ortama
taşımayı amaçlar.\
Kullanıcılar ad, soyad, e-posta ve telefon bilgileriyle randevu
alabilir.\
Berberin belirlediği kurallara göre **tarih ve saat seçimi
kısıtlanmıştır** ve tüm randevular berber paneline yansır.

------------------------------------------------------------------------

## 🧩 Özellikler

### 👤 Kullanıcı Tarafı

-   Ad, soyad, e-posta ve telefon bilgileriyle randevu oluşturma
-   Pazar günleri kapalı olacak şekilde tarih kısıtlaması
-   Sadece **2 hafta ileriye kadar** randevu alabilme
-   Seçilen tarihe göre **müsait saatlerin listelenmesi**
-   Dolu saatlerin otomatik olarak pasif olması

### 📅 Randevu Sistemi

-   Tarih bazlı randevu kontrolü
-   Saat çakışmalarını engelleme
-   Dinamik müsaitlik hesaplama

### 🛠 Berber Paneli (Admin)

-   Tüm randevuları listeleme
-   Kullanıcı bilgilerini görüntüleme
-   Randevu iptal etme
-   Gün / saat bazlı randevu takibi

### 🔐 Güvenlik

-   Session tabanlı giriş sistemi
-   Yetkisiz erişim engelleme
-   Admin panel koruması

------------------------------------------------------------------------

## 🧰 Kullanılan Teknolojiler

-   **Backend:** PHP
-   **Frontend:** HTML, CSS, JavaScript
-   **Veritabanı:** MySQL
-   **Diğer:** Session Management, Date & Time Validation

------------------------------------------------------------------------

## 📁 Proje Yapısı (Örnek)

    /admin
      /controllers
      /views
    /public
      /assets
    /config
    /database
    index.php

------------------------------------------------------------------------

## ⚙️ Kurulum

1.  Projeyi klonla:

```{=html}
<!-- -->
```
    git clone https://github.com/kullanici_adi/repo_adi.git

2.  Proje dizinine gir:

```{=html}
<!-- -->
```
    cd repo_adi

3.  Veritabanını yapılandır:

-   MySQL veritabanı oluştur
-   SQL dosyasını içe aktar
-   `config` klasöründen bağlantı ayarlarını yap

4.  Tarayıcıdan çalıştır:

```{=html}
<!-- -->
```
    http://localhost/proje_klasoru

------------------------------------------------------------------------

## 🔑 Berber Paneli

    /admin

Berber buradan: - Randevuları görüntüleyebilir - Kullanıcı bilgilerini
inceleyebilir - Randevuları iptal edebilir

------------------------------------------------------------------------

## 🎯 Projenin Amacı

-   Gerçek hayattaki berber randevu sürecini dijitalleştirmek
-   Tarih & saat kısıtlamaları ile doğru randevu yönetimi sağlamak
-   PHP ile planlama ve zaman yönetimi mantığını geliştirmek

------------------------------------------------------------------------

## 📌 Geliştirme Fikirleri

-   SMS / E-posta bildirimleri
-   Çoklu berber desteği
-   Hizmet seçimi (saç, sakal vb.)
-   Otomatik randevu onayı

------------------------------------------------------------------------

## 📄 Lisans

Bu proje eğitim ve kişisel gelişim amaçlı geliştirilmiştir.
