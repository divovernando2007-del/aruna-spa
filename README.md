# Aruna Beauty & Spa — Company Profile (PHP + Tailwind + JS)

## Struktur
```
index.php              Halaman utama (semua section)
booking.php            Handler form booking (validasi, simpan, link WhatsApp)
config/data.php        SEMUA KONTEN: nama brand, harga, layanan, paket, testimoni, dll
includes/helpers.php   Fungsi bantu (ikon SVG, foto/placeholder, format rupiah, CSRF)
assets/css/animations.css  Animasi entrance
assets/js/main.js      Trigger animasi, counter, slider, menu mobile, form AJAX
assets/img/            Taruh foto di sini
storage/bookings.json  Data booking masuk (dilindungi .htaccess)
```

## Menjalankan di lokal
Butuh PHP 8+. Dari folder ini jalankan:
```
php -S localhost:8000
```
lalu buka http://localhost:8000 (atau taruh di htdocs XAMPP/Laragon).

## Cara mengisi konten
1. Edit `config/data.php` — ganti semua yang ada di [KURUNG SIKU], nomor WA, email, harga (angka saja, contoh `350000`).
2. Taruh foto di `assets/img/` dengan nama file sesuai yang tertulis di `data.php`
   (mis. `hero-1.jpg`, `service-facial.jpg`). Selama foto belum ada, otomatis tampil kotak placeholder.

## Animasi entrance
- Saat halaman dibuka: elemen dengan class `hero-in` + `data-from="up|down|left|right|zoom|arch"`.
- Saat di-scroll: tambahkan atribut `data-animate="fade-up|fade-down|fade-left|fade-right|zoom"` ke elemen apa saja.
- Jeda: `data-delay="200"` (milidetik). Ubah kecepatan global di `--dur` pada `animations.css`.
- Otomatis nonaktif untuk pengguna dengan setelan "reduce motion".

## Booking
- Data tersimpan di `storage/bookings.json`, lalu pengunjung diarahkan ke WhatsApp admin dengan pesan otomatis.
- Email notifikasi memakai `mail()` — aktif jika hosting mendukung. Untuk lebih andal, ganti dengan PHPMailer + SMTP.
- Di hosting, pastikan folder `storage/` bisa ditulis (permission 755/775).

## Tailwind untuk production
Saat ini memakai Tailwind CDN (praktis untuk development). Untuk website live, sebaiknya build CSS:
```
npm install -D tailwindcss@3
npx tailwindcss init
```
Salin isi `tailwind.config` dari `<head>` index.php ke `tailwind.config.js`, set `content: ["./**/*.php", "./assets/js/*.js"]`,
lalu `npx tailwindcss -i input.css -o assets/css/tailwind.css --minify` dan ganti script CDN dengan `<link>` ke file itu.
