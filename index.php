<?php
session_start();
require __DIR__ . '/config/data.php';
require __DIR__ . '/includes/helpers.php';
$waLink = 'https://wa.me/' . $site['whatsapp'];
?>
<!doctype html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($site['title']) ?></title>
  <meta name="description" content="<?= e($site['desc']) ?>">

  <!-- Penanda JS aktif (dipakai CSS animasi) -->
  <script>document.documentElement.classList.add('js');</script>

  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Tailwind (CDN untuk development — lihat README untuk versi production) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            cream:    '#F7F2EC',
            sand:     '#EFE6DA',
            linen:    '#F1E9DF',
            clay:     '#8B5E3C',
            cocoa:    '#4A3426',
            espresso: '#2A211C',
            muted:    '#6B5D53',
            line:     '#DCCDBB',
          },
          fontFamily: {
            serif: ['"Playfair Display"', 'Georgia', 'serif'],
            sans:  ['"DM Sans"', 'system-ui', 'sans-serif'],
          },
          boxShadow: { soft: '0 18px 40px rgba(74,52,38,.12)' },
        },
      },
    };
  </script>
  <link rel="stylesheet" href="assets/css/animations.css">
</head>
<body class="bg-cream font-sans text-espresso antialiased overflow-x-hidden">

<!-- ================= TOP BAR ================= -->
<div class="hero-in bg-espresso text-[#EFE6DA] text-xs tracking-wider" data-from="down">
  <div class="max-w-7xl mx-auto px-5 md:px-8 flex flex-wrap items-center justify-between gap-3 min-h-10">
    <span>SELF CARE HARI INI, HIDUP LEBIH CERAH ESOK HARI</span>
    <a href="#booking" class="inline-flex items-center gap-1.5 py-2 hover:text-white">BOOKING SEKARANG <?= icon('arrow', 'w-3.5 h-3.5') ?></a>
  </div>
</div>

<!-- ================= NAVBAR ================= -->
<header id="navbar" class="sticky top-0 z-40 bg-cream/90 backdrop-blur transition-shadow">
  <div class="hero-in max-w-7xl mx-auto px-5 md:px-8 flex items-center justify-between gap-6 h-20" data-from="down" data-delay="100">
    <a href="#beranda" class="flex flex-col leading-none">
      <span class="font-serif text-[28px] tracking-wider"><?= e($site['name']) ?></span>
      <span class="text-[10px] tracking-[.32em] text-muted mt-1"><?= e($site['tagline']) ?></span>
    </a>

    <nav aria-label="Menu utama" class="hidden lg:flex gap-8 text-sm">
      <?php foreach (['beranda' => 'Beranda', 'layanan' => 'Layanan', 'paket' => 'Paket', 'tentang' => 'Tentang', 'kontak' => 'Kontak'] as $id => $label): ?>
        <a href="#<?= $id ?>" data-nav="<?= $id ?>" class="nav-link py-3 border-b-[1.5px] border-transparent hover:text-clay transition-colors"><?= $label ?></a>
      <?php endforeach; ?>
    </nav>

    <div class="flex items-center gap-1.5">
      <button class="hidden sm:inline-flex w-11 h-11 items-center justify-center rounded-full hover:bg-sand" aria-label="Cari"><?= icon('search') ?></button>
      <button class="hidden sm:inline-flex w-11 h-11 items-center justify-center rounded-full hover:bg-sand" aria-label="Akun"><?= icon('user') ?></button>
      <a href="#booking" class="hidden sm:inline-flex items-center gap-2.5 bg-espresso text-cream px-5 h-11 rounded-lg text-sm font-medium hover:bg-cocoa hover:-translate-y-0.5 transition">
        <?= icon('calendar', 'w-4 h-4') ?> Book Now
      </a>
      <button id="menuBtn" class="lg:hidden inline-flex w-11 h-11 items-center justify-center rounded-full hover:bg-sand" aria-label="Buka menu" aria-expanded="false" aria-controls="mobileMenu"><?= icon('menu', 'w-6 h-6') ?></button>
    </div>
  </div>

  <!-- Menu mobile -->
  <nav id="mobileMenu" aria-label="Menu mobile" class="lg:hidden hidden border-t border-line bg-cream">
    <div class="px-5 py-4 flex flex-col">
      <?php foreach (['beranda' => 'Beranda', 'layanan' => 'Layanan', 'paket' => 'Paket', 'tentang' => 'Tentang', 'kontak' => 'Kontak'] as $id => $label): ?>
        <a href="#<?= $id ?>" class="py-3 border-b border-line/60"><?= $label ?></a>
      <?php endforeach; ?>
      <a href="#booking" class="mt-4 inline-flex justify-center items-center gap-2 bg-espresso text-cream h-12 rounded-lg font-medium">Book Now</a>
    </div>
  </nav>
</header>

<main>

<!-- ================= HERO ================= -->
<section id="beranda" class="pt-6 pb-20">
  <div class="max-w-7xl mx-auto px-5 md:px-8 grid lg:grid-cols-2 gap-14 items-center">
    <div>
      <p class="hero-in text-xs tracking-[.18em] uppercase text-clay" data-from="up" data-delay="200">Beauty · Wellness · Self Care</p>
      <h1 class="hero-in font-serif text-[52px] sm:text-7xl xl:text-[88px] leading-[1.02] mt-5" data-from="up" data-delay="350">
        Rileks.<br>Bersinar.<br><em class="text-clay">Jadi Dirimu.</em>
      </h1>
      <p class="hero-in text-muted text-[17px] leading-relaxed max-w-md mt-6" data-from="up" data-delay="550"><?= e($site['desc']) ?></p>

      <div class="hero-in flex flex-wrap items-center gap-5 mt-8" data-from="up" data-delay="700">
        <a href="#booking" class="inline-flex items-center gap-2.5 bg-espresso text-cream px-6 h-12 rounded-lg text-sm font-medium hover:bg-cocoa hover:-translate-y-0.5 transition">
          Book Appointment <?= icon('arrow', 'w-4 h-4') ?>
        </a>
        <a href="#cerita" class="inline-flex items-center gap-3 text-sm font-medium group">
          <span class="w-11 h-11 rounded-full border border-espresso inline-flex items-center justify-center group-hover:bg-espresso group-hover:text-cream transition"><?= icon('play', 'w-3.5 h-3.5') ?></span>
          Tonton Cerita Kami
        </a>
      </div>

      <div class="hero-in flex items-center gap-3.5 mt-11" data-from="up" data-delay="850">
        <div class="flex">
          <span class="w-11 h-11 rounded-full bg-[#D9C3AB] border-[3px] border-cream"></span>
          <span class="w-11 h-11 rounded-full bg-[#C4A88C] border-[3px] border-cream -ml-3"></span>
          <span class="w-11 h-11 rounded-full bg-[#A98A6E] border-[3px] border-cream -ml-3"></span>
        </div>
        <div>
          <div class="font-serif text-2xl font-semibold"><?= $stats[0]['value'] . e($stats[0]['suffix']) ?></div>
          <div class="text-muted text-sm">Klien Bahagia</div>
        </div>
      </div>
    </div>

    <!-- Slider hero -->
    <div class="flex gap-5 items-stretch">
      <div class="relative flex-1 min-w-0">
        <div class="hero-in relative h-[460px] sm:h-[560px] rounded-t-[300px] rounded-b-3xl overflow-hidden" data-from="arch" data-delay="300">
          <?php foreach ($heroSlides as $i => $s): ?>
            <div class="hero-slide absolute inset-0 <?= $i === 0 ? 'active' : '' ?>" data-slide="<?= $i ?>">
              <?= img($s['img'], $s['label'], '', ['#D9C3AB', '#CBB197', '#BFA285'][$i % 3]) ?>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="hero-in absolute -left-4 sm:-left-7 bottom-9" data-from="zoom" data-delay="1050">
          <div class="animate-float flex items-center gap-3.5 bg-white px-4 py-3.5 rounded-2xl shadow-soft">
            <span class="w-10 h-10 rounded-full bg-linen text-clay inline-flex items-center justify-center"><?= icon('leaf') ?></span>
            <span class="text-xs font-semibold tracking-wider leading-snug">NATURAL &amp;<br>SKIN SAFE</span>
          </div>
        </div>
      </div>

      <div class="hidden md:flex flex-col items-center gap-3.5 w-[76px]">
        <div class="hero-in text-center mb-1.5" data-from="right" data-delay="600">
          <div id="slideNum" class="font-serif text-2xl">01</div>
          <div class="text-muted text-xs">/ <?= str_pad((string) count($heroSlides), 2, '0', STR_PAD_LEFT) ?></div>
        </div>
        <?php foreach ($heroSlides as $i => $s): ?>
          <button class="hero-in thumb w-[76px] h-[76px] rounded-xl overflow-hidden ring-2 ring-offset-2 ring-offset-cream transition <?= $i === 0 ? 'ring-clay' : 'ring-transparent' ?>"
                  data-from="right" data-delay="<?= 700 + $i * 100 ?>" data-go="<?= $i ?>" aria-label="Tampilkan slide <?= $i + 1 ?>">
            <?= img($s['img'], '', '', ['#D9C3AB', '#CBB197', '#BFA285'][$i % 3]) ?>
          </button>
        <?php endforeach; ?>
        <button id="nextSlide" class="hero-in w-11 h-11 rounded-full border border-line inline-flex items-center justify-center hover:bg-espresso hover:text-cream transition"
                data-from="right" data-delay="1000" aria-label="Slide berikutnya"><?= icon('plus', 'w-4 h-4') ?></button>
      </div>
    </div>
  </div>
</section>

<!-- ================= FEATURE STRIP ================= -->
<section class="bg-sand">
  <div class="max-w-7xl mx-auto px-5 md:px-8 py-7 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <?php foreach ($features as $i => $f): ?>
      <div class="flex items-center gap-3.5" data-animate="fade-up" data-delay="<?= $i * 120 ?>">
        <span class="text-clay"><?= icon($f['icon'], 'w-8 h-8') ?></span>
        <div><div class="font-semibold text-sm"><?= e($f['title']) ?></div><div class="text-muted text-xs"><?= e($f['desc']) ?></div></div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ================= ABOUT ================= -->
<section id="tentang" class="py-24">
  <div class="max-w-7xl mx-auto px-5 md:px-8 grid md:grid-cols-2 lg:grid-cols-3 gap-12 items-center">
    <div class="h-[400px] rounded-2xl overflow-hidden" data-animate="fade-left"><?= img('interior-01.jpg', 'Foto interior spa', '', '#DCC8B2') ?></div>
    <div data-animate="fade-up" data-delay="120">
      <p class="text-xs tracking-[.18em] uppercase text-clay">Tentang Kami</p>
      <h2 class="font-serif text-4xl leading-tight mt-3.5">Lebih dari Sekadar<br><em class="text-clay">Pengalaman Spa</em></h2>
      <p class="text-muted leading-relaxed mt-5 mb-7">Di Aruna, kami percaya kecantikan adalah bentuk merawat diri. Terapis ahli, produk premium, dan suasana yang tenang kami hadirkan agar kamu tampil baik, merasa baik, dan menjadi versi dirimu yang paling percaya diri.</p>
      <a href="#layanan" class="inline-flex items-center gap-2.5 bg-espresso text-cream px-6 h-12 rounded-lg text-sm font-medium hover:bg-cocoa transition">Selengkapnya <?= icon('arrow', 'w-4 h-4') ?></a>
    </div>
    <div class="grid grid-cols-2 gap-x-6 gap-y-7 md:col-span-2 lg:col-span-1 lg:border-l border-line lg:pl-8" data-animate="fade-right" data-delay="240">
      <?php foreach ($stats as $s): ?>
        <div>
          <div class="font-serif text-[38px]"><span data-count="<?= (int) $s['value'] ?>">0</span><?= e($s['suffix']) ?></div>
          <div class="text-muted text-sm mt-1"><?= e($s['label']) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================= SERVICES ================= -->
<section id="layanan" class="pb-24">
  <div class="max-w-7xl mx-auto px-5 md:px-8">
    <div class="flex flex-wrap items-end justify-between gap-4 mb-8" data-animate="fade-up">
      <div><h2 class="font-serif text-4xl">Jelajahi Layanan Kami</h2><p class="text-muted mt-2">Kecantikan. Relaksasi. Peremajaan.</p></div>
      <a href="#layanan" class="inline-flex items-center gap-1.5 text-sm hover:text-clay">Lihat Semua <?= icon('arrow', 'w-3.5 h-3.5') ?></a>
    </div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
      <?php foreach ($services as $i => $s): ?>
        <article class="group bg-white rounded-2xl overflow-hidden hover:-translate-y-1.5 hover:shadow-soft transition duration-300" data-animate="fade-up" data-delay="<?= $i * 120 ?>">
          <div class="h-60 overflow-hidden"><div class="h-full group-hover:scale-105 transition duration-700"><?= img($s['img'], $s['label'], '', ['#E2CFBA', '#D6BEA4', '#CDB296', '#E0CAB3'][$i % 4]) ?></div></div>
          <div class="p-5 flex items-center justify-between gap-3">
            <div><h3 class="font-semibold"><?= e($s['name']) ?></h3><p class="text-muted text-sm mt-1"><?= e($s['desc']) ?></p></div>
            <a href="#booking" data-service="<?= e($s['name']) ?>" class="w-11 h-11 shrink-0 rounded-full border border-line inline-flex items-center justify-center group-hover:bg-espresso group-hover:text-cream transition" aria-label="Booking <?= e($s['name']) ?>"><?= icon('arrow', 'w-4 h-4') ?></a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ================= FOOTER ================= -->
<footer id="kontak" class="bg-sand pt-16 pb-7">
  <div class="max-w-7xl mx-auto px-5 md:px-8">
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10" data-animate="fade-up">
      <div>
        <div class="font-serif text-[26px] tracking-wider"><?= e($site['name']) ?></div>
        <div class="text-[10px] tracking-[.32em] text-muted mt-1"><?= e($site['tagline']) ?></div>
        <p class="text-muted text-sm leading-relaxed my-4">Beauty. Wellness. Self Care.<br>Karena dirimu yang bahagia adalah dirimu yang paling cantik.</p>
        <p class="text-muted text-sm leading-relaxed mb-4"><?= e($site['address']) ?><br><?= e($site['hours']) ?></p>
        <div class="flex gap-1.5">
          <a href="<?= e($site['instagram']) ?>" target="_blank" rel="noopener" class="w-11 h-11 rounded-full border border-line inline-flex items-center justify-center hover:bg-espresso hover:text-cream transition" aria-label="Instagram"><?= icon('instagram', 'w-[18px] h-[18px]') ?></a>
          <a href="<?= e($site['tiktok']) ?>" target="_blank" rel="noopener" class="w-11 h-11 rounded-full border border-line inline-flex items-center justify-center hover:bg-espresso hover:text-cream transition" aria-label="TikTok"><?= icon('tiktok', 'w-[18px] h-[18px]') ?></a>
          <a href="<?= e($waLink) ?>" target="_blank" rel="noopener" class="w-11 h-11 rounded-full border border-line inline-flex items-center justify-center hover:bg-espresso hover:text-cream transition" aria-label="WhatsApp"><?= icon('whatsapp', 'w-[18px] h-[18px]') ?></a>
        </div>
      </div>
      <?php
      $footerCols = [
          'Layanan'    => ['Facial Treatment' => '#layanan', 'Massage Therapy' => '#layanan', 'Body Treatment' => '#layanan', 'Nail Care' => '#layanan', 'Paket' => '#paket'],
          'Perusahaan' => ['Tentang Kami' => '#tentang', 'Tim Kami' => '#tentang', 'Blog' => '#blog', 'Kontak' => '#kontak', 'Karier' => '#kontak'],
          'Bantuan'    => ['FAQ' => '#kontak', 'Booking' => '#booking', 'Pembatalan' => '#kontak', 'Kebijakan Privasi' => '#kontak', 'Syarat Layanan' => '#kontak'],
      ];
      foreach ($footerCols as $title => $links): ?>
        <nav aria-label="<?= e($title) ?>">
          <h4 class="font-semibold text-sm mb-3.5"><?= e($title) ?></h4>
          <ul class="text-sm">
            <?php foreach ($links as $label => $href): ?><li><a href="<?= $href ?>" class="block py-1.5 hover:text-clay transition-colors"><?= e($label) ?></a></li><?php endforeach; ?>
          </ul>
        </nav>
      <?php endforeach; ?>
    </div>
    <div class="flex flex-wrap justify-between gap-3 border-t border-line mt-12 pt-6 text-xs text-muted">
      <span>© <?= date('Y') ?> <?= e(ucfirst(strtolower($site['name']))) ?> Beauty &amp; Spa. All rights reserved.</span>
      <span class="tracking-[.14em] text-espresso">A BRIGHTER YOU, EVERYDAY.</span>
    </div>
  </div>
</footer>

<!-- Tombol WhatsApp melayang -->
<a href="<?= e($waLink) ?>" target="_blank" rel="noopener" class="fixed right-5 bottom-5 z-40 w-14 h-14 rounded-full bg-espresso text-cream inline-flex items-center justify-center shadow-soft hover:bg-cocoa transition" aria-label="Chat WhatsApp"><?= icon('whatsapp', 'w-6 h-6') ?></a>

<script src="assets/js/main.js"></script>
</body>
</html>
