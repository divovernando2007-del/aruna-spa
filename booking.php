<?php
/**
 * Handler form booking.
 * - Validasi input + CSRF + honeypot anti-spam
 * - Simpan ke storage/bookings.json
 * - (Opsional) kirim email notifikasi ke admin
 * - Balikkan link WhatsApp berisi detail booking
 */
session_start();
require __DIR__ . '/config/data.php';
require __DIR__ . '/includes/helpers.php';

$wantsJson = str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json');

function respond(bool $ok, string $message, array $extra = [], int $code = 200): void
{
    global $wantsJson;
    if ($wantsJson) {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['ok' => $ok, 'message' => $message] + $extra);
    } else {
        // Fallback jika JS mati: kembali ke halaman utama
        header('Location: index.php?booking=' . ($ok ? 'success' : 'error') . '#booking');
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Metode tidak diizinkan.', [], 405);
}

// Honeypot: bot biasanya mengisi semua field
if (!empty($_POST['website'])) {
    respond(true, 'Terima kasih!');
}

// CSRF
if (empty($_POST['csrf']) || empty($_SESSION['csrf']) || !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
    respond(false, 'Sesi habis, silakan muat ulang halaman.', [], 419);
}

// Ambil & bersihkan input
$name    = trim((string) ($_POST['name'] ?? ''));
$phone   = preg_replace('/[^0-9+]/', '', (string) ($_POST['phone'] ?? ''));
$service = trim((string) ($_POST['service'] ?? ''));
$date    = (string) ($_POST['date'] ?? '');
$time    = (string) ($_POST['time'] ?? '');
$note    = trim((string) ($_POST['note'] ?? ''));

// Validasi
$errors = [];
if (mb_strlen($name) < 2 || mb_strlen($name) > 80)           $errors[] = 'Nama wajib diisi.';
if (!preg_match('/^(\+62|62|0)8[0-9]{7,12}$/', $phone))       $errors[] = 'Nomor WhatsApp tidak valid.';
if (!in_array($service, $bookingOptions, true))              $errors[] = 'Pilih layanan yang tersedia.';
$d = DateTime::createFromFormat('Y-m-d', $date);
if (!$d || $d->format('Y-m-d') !== $date || $date < date('Y-m-d')) $errors[] = 'Tanggal tidak valid.';
if (!preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $time))        $errors[] = 'Jam tidak valid.';
if (mb_strlen($note) > 500)                                   $errors[] = 'Catatan terlalu panjang.';

if ($errors) {
    respond(false, implode(' ', $errors), ['errors' => $errors], 422);
}

// Simpan ke file JSON (pakai lock supaya aman jika ada booking bersamaan)
$booking = [
    'id'         => strtoupper(bin2hex(random_bytes(4))),
    'name'       => $name,
    'phone'      => $phone,
    'service'    => $service,
    'date'       => $date,
    'time'       => $time,
    'note'       => $note,
    'created_at' => date('c'),
    'ip'         => $_SERVER['REMOTE_ADDR'] ?? '',
];

$file = __DIR__ . '/storage/bookings.json';
$fp = fopen($file, 'c+');
if (!$fp || !flock($fp, LOCK_EX)) {
    respond(false, 'Server sedang sibuk, coba lagi sebentar.', [], 500);
}
$all = json_decode(stream_get_contents($fp) ?: '[]', true) ?: [];
$all[] = $booking;
ftruncate($fp, 0);
rewind($fp);
fwrite($fp, json_encode($all, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
fflush($fp);
flock($fp, LOCK_UN);
fclose($fp);

// (Opsional) email notifikasi ke admin — aktif jika server mendukung mail()
$tgl = $d->format('d/m/Y');
$body = "Booking baru #{$booking['id']}\n\nNama: $name\nWA: $phone\nLayanan: $service\nJadwal: $tgl, $time\nCatatan: " . ($note ?: '-');
@mail($site['email'], "Booking Baru #{$booking['id']} — $service", $body, 'Content-Type: text/plain; charset=UTF-8');

// Link WhatsApp ke admin dengan pesan otomatis
$waText = "Halo {$site['name']}, saya ingin booking:\n"
        . "• Nama: $name\n• Layanan: $service\n• Jadwal: $tgl, jam $time\n"
        . ($note ? "• Catatan: $note\n" : '')
        . "Kode booking: #{$booking['id']}";
$waLink = 'https://wa.me/' . $site['whatsapp'] . '?text=' . rawurlencode($waText);

// Token baru untuk mencegah submit ganda
$_SESSION['csrf'] = bin2hex(random_bytes(32));

respond(true, "Booking #{$booking['id']} terkirim! Kamu akan diarahkan ke WhatsApp untuk konfirmasi.", [
    'id'       => $booking['id'],
    'whatsapp' => $waLink,
    'csrf'     => $_SESSION['csrf'],
]);
