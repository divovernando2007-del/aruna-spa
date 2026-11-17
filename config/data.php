<?php
/**
 * ============================================================
 *  DATA KONTEN WEBSITE
 *  Ganti semua isi di file ini sesuai data spa klien.
 *  Semua yang di dalam [KURUNG SIKU] wajib diisi.
 * ============================================================
 */

$site = [
    'name'      => 'ARUNA',
    'tagline'   => 'BEAUTY & SPA',
    'title'     => 'Aruna Beauty & Spa — Rileks. Bersinar. Jadi Dirimu.',
    'desc'      => 'Perawatan kecantikan dan spa premium untuk menyegarkan tubuh, menenangkan pikiran, dan memancarkan kecantikan alamimu.',
    'whatsapp'  => '6281234567890',          // [NOMOR WA] format 62xxxx tanpa + dan spasi
    'email'     => 'halo@arunaspa.com',      // [EMAIL] tujuan notifikasi booking
    'address'   => '[Alamat lengkap spa]',
    'hours'     => 'Setiap hari 10.00 – 21.00', // [JAM BUKA]
    'instagram' => 'https://instagram.com/[USERNAME]',
    'tiktok'    => 'https://tiktok.com/@[USERNAME]',
    'promo'     => '[00]%',                   // besar diskon kunjungan pertama
];

$heroSlides = [
    ['img' => 'img-01.jpg', 'label' => 'Foto hero: klien rileks saat spa'],
    ['img' => 'img-02.jpg', 'label' => 'Foto hero: pijat punggung'],
    ['img' => 'img-03.jpg', 'label' => 'Foto hero: lilin & aromaterapi'],
];

$features = [
    ['icon' => 'lotus',    'title' => 'Terapis Ahli',        'desc' => 'Terlatih & bersertifikat'],
    ['icon' => 'leaf',     'title' => 'Produk Premium',      'desc' => '100% aman untuk kulit'],
    ['icon' => 'calendar', 'title' => 'Booking Mudah',       'desc' => 'Online & langsung di spa'],
    ['icon' => 'heart',    'title' => 'Suasana Menenangkan', 'desc' => 'Tenang · Bersih · Privat'],
];

// value = angka akhir counter, suffix = tambahan di belakang angka
$stats = [
    ['value' => 5,   'suffix' => 'K+', 'label' => 'Klien Bahagia'],   // [GANTI]
    ['value' => 10,  'suffix' => '+',  'label' => 'Terapis Ahli'],    // [GANTI]
    ['value' => 15,  'suffix' => '+',  'label' => 'Jenis Perawatan'], // [GANTI]
    ['value' => 100, 'suffix' => '%',  'label' => 'Kepuasan Klien'],  // [GANTI]
];

$services = [
    ['name' => 'Facial Treatment', 'desc' => 'Kulit sehat & bercahaya',  'img' => 'facial.jpg', 'label' => 'Foto facial'],
    ['name' => 'Massage Therapy',  'desc' => 'Rileks tubuh & pikiran',   'img' => 'massage.jpg', 'label' => 'Foto pijat'],
    ['name' => 'Body Treatment',   'desc' => 'Peremajaan kulit tubuh',   'img' => 'body.jpg', 'label' => 'Foto body scrub'],
    ['name' => 'Nail Care',        'desc' => 'Elegan & modern',          'img' => 'nail.jpg', 'label' => 'Foto nail care'],
];

// price dalam rupiah (angka saja), 0 = tampil "Rp [HARGA]"
$treatments = [
    ['name' => 'Hydra Facial',         'price' => 599000, 'desc' => 'Pembersihan mendalam & hidrasi', 'img' => 'treat-hydra.jpg'],
    ['name' => 'Aromatherapy Massage', 'price' => 399000, 'desc' => 'Lepas stres & relaksasi',        'img' => 'treat-aroma.jpg'],
    ['name' => 'Gold Glow Treatment',  'price' => 999000, 'desc' => 'Mencerahkan & meremajakan',      'img' => 'treat-gold.jpg'],
    ['name' => 'Manicure & Pedicure',  'price' => 299000, 'desc' => 'Perawatan kuku lengkap',         'img' => 'treat-mani.jpg'],
];

$whyUs = [
    ['icon' => 'leaf',    'title' => 'Perawatan Personal', 'desc' => 'Disesuaikan dengan jenis kulit & kebutuhanmu'],
    ['icon' => 'sparkle', 'title' => 'Produk Premium',     'desc' => 'Aman, alami, dan efektif'],
    ['icon' => 'shield',  'title' => 'Higienis & Aman',    'desc' => 'Ruang bersih dan nyaman'],
    ['icon' => 'lotus',   'title' => 'Suasana Relaksasi',  'desc' => 'Dirancang untuk ketenanganmu'],
];


$packages = [
    ['name' => 'Essentials',    'price' => 1299000, 'badge' => '',           'img' => 'pkg-essentials.jpg', 'items' => ['Signature Facial', 'Aroma Massage ([00] menit)', 'Complimentary Drink']],
    ['name' => 'Renew & Relax', 'price' => 2899000, 'badge' => 'Populer',    'img' => 'pkg-renew.jpg',      'items' => ['Full Body Massage', 'Facial Treatment', 'Foot Therapy', 'Herbal Tea']],
    ['name' => 'Luxury Escape', 'price' => 3999000, 'badge' => 'Best Value', 'img' => 'pkg-luxury.jpg',     'items' => ['Full Body Massage', 'Gold Facial', 'Manicure & Pedicure', 'Refreshments']],
];

// Pilihan layanan di form booking = semua treatment + paket
$bookingOptions = array_merge(
    array_column($treatments, 'name'),
    array_map(fn($p) => 'Paket ' . $p['name'], $packages)
);
