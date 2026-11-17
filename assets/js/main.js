/* =========================================================
   ARUNA SPA — main.js
   1. Animasi entrance hero (saat halaman dibuka)
   2. Animasi entrance saat scroll (IntersectionObserver)
   3. Counter angka statistik
   4. Slider hero
   5. Menu mobile + navbar aktif
   6. Form booking (AJAX ke booking.php)
   ========================================================= */
(() => {
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Pasang delay dari atribut data-delay ke CSS variable --delay
  document.querySelectorAll('[data-delay]').forEach((el) => {
    el.style.setProperty('--delay', `${parseInt(el.dataset.delay, 10) || 0}ms`);
  });

  /* ---------- 1. Hero entrance ---------- */
  const playHero = () => {
    document.querySelectorAll('.hero-in').forEach((el) => el.classList.add('is-visible'));
  };
  // double rAF supaya state awal sempat ter-render dulu, baru transisi berjalan
  requestAnimationFrame(() => requestAnimationFrame(playHero));

  /* ---------- 2. Scroll entrance ---------- */
  const animated = document.querySelectorAll('[data-animate]');
  if (reduceMotion || !('IntersectionObserver' in window)) {
    animated.forEach((el) => el.classList.add('is-visible'));
  } else {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('is-visible');
        io.unobserve(entry.target); // animasi cukup sekali
      });
    }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });
    animated.forEach((el) => io.observe(el));
  }

  /* ---------- 3. Counter angka ---------- */
  const counters = document.querySelectorAll('[data-count]');
  const runCounter = (el) => {
    const target = parseInt(el.dataset.count, 10) || 0;
    if (reduceMotion) { el.textContent = target; return; }
    const duration = 1600;
    const start = performance.now();
    const tick = (now) => {
      const p = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - p, 3);
      el.textContent = Math.round(target * eased);
      if (p < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  };
  if ('IntersectionObserver' in window) {
    const cio = new IntersectionObserver((entries) => {
      entries.forEach((e) => { if (e.isIntersecting) { runCounter(e.target); cio.unobserve(e.target); } });
    }, { threshold: 0.6 });
    counters.forEach((c) => cio.observe(c));
  } else {
    counters.forEach(runCounter);
  }

  /* ---------- 4. Slider hero ---------- */
  const slides = document.querySelectorAll('.hero-slide');
  const thumbs = document.querySelectorAll('.thumb');
  const slideNum = document.getElementById('slideNum');
  let current = 0;
  let timer;

  const goTo = (i) => {
    current = (i + slides.length) % slides.length;
    slides.forEach((s, idx) => s.classList.toggle('active', idx === current));
    thumbs.forEach((t, idx) => {
      t.classList.toggle('ring-clay', idx === current);
      t.classList.toggle('ring-transparent', idx !== current);
    });
    if (slideNum) slideNum.textContent = String(current + 1).padStart(2, '0');
  };
  const autoplay = () => {
    clearInterval(timer);
    if (!reduceMotion && slides.length > 1) timer = setInterval(() => goTo(current + 1), 3000);
  };
  thumbs.forEach((t) => t.addEventListener('click', () => { goTo(+t.dataset.go); autoplay(); }));
  document.getElementById('nextSlide')?.addEventListener('click', () => { goTo(current + 1); autoplay(); });
  autoplay();

  /* ---------- 5. Menu mobile & navbar ---------- */
  const menuBtn = document.getElementById('menuBtn');
  const mobileMenu = document.getElementById('mobileMenu');
  menuBtn?.addEventListener('click', () => {
    const open = mobileMenu.classList.toggle('hidden') === false;
    menuBtn.setAttribute('aria-expanded', String(open));
  });
  mobileMenu?.querySelectorAll('a').forEach((a) => a.addEventListener('click', () => {
    mobileMenu.classList.add('hidden');
    menuBtn.setAttribute('aria-expanded', 'false');
  }));

  // Bayangan navbar saat scroll
  const navbar = document.getElementById('navbar');
  const onScroll = () => navbar?.classList.toggle('shadow-[0_6px_24px_rgba(74,52,38,.08)]', window.scrollY > 40);
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  // Garis bawah menu sesuai section yang sedang dilihat
  const navLinks = document.querySelectorAll('.nav-link');
  const sections = [...navLinks].map((l) => document.getElementById(l.dataset.nav)).filter(Boolean);
  if ('IntersectionObserver' in window) {
    const sio = new IntersectionObserver((entries) => {
      entries.forEach((e) => {
        if (!e.isIntersecting) return;
        navLinks.forEach((l) => {
          const active = l.dataset.nav === e.target.id;
          l.classList.toggle('border-espresso', active);
          l.classList.toggle('font-semibold', active);
          l.classList.toggle('border-transparent', !active);
        });
      });
    }, { rootMargin: '-45% 0px -50% 0px' });
    sections.forEach((s) => sio.observe(s));
  }

  /* ---------- 6. Form booking ---------- */
  const form = document.getElementById('bookingForm');
  const select = document.getElementById('serviceSelect');
  const msg = document.getElementById('formMsg');

  // Klik tombol "Book" di kartu → layanan otomatis terpilih
  document.querySelectorAll('[data-service]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const val = btn.dataset.service;
      if (select && [...select.options].some((o) => o.value === val || o.text === val)) select.value = val;
    });
  });

  const showMsg = (text, ok) => {
    msg.textContent = text;
    msg.className = `sm:col-span-2 text-sm rounded-lg px-4 py-3 ${ok ? 'bg-[#E4EFE2] text-[#2F5A2B]' : 'bg-[#F6E1DC] text-[#8A2E1F]'}`;
  };

  form?.addEventListener('submit', async (ev) => {
    ev.preventDefault();
    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }
    const btn = form.querySelector('button[type="submit"]');
    const label = btn.querySelector('.btn-label');
    btn.disabled = true;
    label.textContent = 'Mengirim...';

    try {
      const res = await fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: { Accept: 'application/json' },
      });
      const data = await res.json();
      if (!res.ok || !data.ok) throw new Error(data.message || 'Gagal mengirim booking.');

      showMsg(data.message, true);
      form.reset();
      if (data.csrf) form.elements.csrf.value = data.csrf; // token baru dari server
      // Lanjutkan ke WhatsApp dengan pesan yang sudah terisi
      if (data.whatsapp) setTimeout(() => window.open(data.whatsapp, '_blank', 'noopener'), 900);
    } catch (err) {
      showMsg(err.message || 'Terjadi kesalahan, coba lagi.', false);
    } finally {
      btn.disabled = false;
      label.textContent = 'Kirim Booking';
    }
  });
})();
