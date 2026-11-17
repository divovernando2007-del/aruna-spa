<?php
/** Escape output HTML */
function e(?string $s): string
{
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}

/** Format harga: 0 => placeholder */
function rupiah(int $n): string
{
    return $n > 0 ? 'Rp ' . number_format($n, 0, ',', '.') : 'Rp [HARGA]';
}

/**
 * Tampilkan foto dari assets/img/. Kalau file belum ada,
 * tampilkan kotak placeholder berwarna + label isi foto.
 */
function img(string $file, string $alt, string $class = '', string $bg = '#E6D6C3'): string
{
    $path = __DIR__ . '/../assets/img/' . $file;
    if ($file !== '' && is_file($path)) {
        return '<img src="assets/img/' . e($file) . '" alt="' . e($alt) . '" loading="lazy" class="w-full h-full object-cover ' . e($class) . '">';
    }
    return '<div class="w-full h-full flex items-end ' . e($class) . '" style="background:' . e($bg) . '" role="img" aria-label="' . e($alt) . '">'
         . '<span class="m-3 inline-flex items-center gap-1.5 rounded-full bg-white/85 px-2.5 py-1 text-[11px] tracking-wide text-cocoa">'
         . icon('image', 'w-3 h-3') . e($alt) . '</span></div>';
}

/** Ikon garis (SVG inline) */
function icon(string $name, string $class = 'w-5 h-5'): string
{
    $paths = [
        'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'leaf'     => '<path d="M5 19c0-8 6-14 15-14 0 9-6 15-14 15"/><path d="M5 19l8-8"/>',
        'lotus'    => '<path d="M12 20c-4 0-8-2-9-6 3 0 6 1 9 4 3-3 6-4 9-4-1 4-5 6-9 6z"/><path d="M12 18c-2-2-3-5-3-8 1 0 2 1 3 2 1-1 2-2 3-2 0 3-1 6-3 8z"/>',
        'calendar' => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/>',
        'heart'    => '<path d="M12 20s-7-4.5-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.5-7 10-7 10z"/>',
        'shield'   => '<path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6z"/><path d="M9 12l2 2 4-4"/>',
        'sparkle'  => '<path d="M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8z"/>',
        'search'   => '<circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4"/>',
        'user'     => '<circle cx="12" cy="8" r="4"/><path d="M4 21c1-4 4-6 8-6s7 2 8 6"/>',
        'plus'     => '<path d="M12 5v14M5 12h14"/>',
        'menu'     => '<path d="M4 7h16M4 12h16M4 17h16"/>',
        'close'    => '<path d="M6 6l12 12M18 6L6 18"/>',
        'image'    => '<rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="9" cy="10" r="2"/><path d="M21 17l-5-5-9 8"/>',
        'instagram'=> '<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".8" fill="currentColor"/>',
        'tiktok'   => '<path d="M14 3v11.5a3.5 3.5 0 1 1-3.5-3.5"/><path d="M14 3c.5 2.8 2.4 4.6 5 5"/>',
        'whatsapp' => '<path d="M4 20l1.3-4A8 8 0 1 1 8 18.7z"/>',
    ];
    if ($name === 'play') {
        return '<svg class="' . e($class) . '" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5l11 7-11 7z"/></svg>';
    }
    return '<svg class="' . e($class) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'
         . ($paths[$name] ?? '') . '</svg>';
}

/** Token CSRF untuk form booking */
function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}
