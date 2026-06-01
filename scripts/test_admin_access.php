<?php
// Skrip untuk menguji login dan akses ke admin.php menggunakan cURL
// Pastikan server dev PHP sedang berjalan: php -S localhost:8000

$loginUrl = 'http://localhost:8000/login.php';
$adminUrl = 'http://localhost:8000/admin.php';
$cookieFile = __DIR__ . '/cookie.txt';

// 1) Kirim POST untuk login
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $loginUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'email' => 'admin@local',
    'password' => 'admin123'
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
$response = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

echo "Login request finished. HTTP code: {$info['http_code']}\n";

// 2) Akses admin page dengan cookie yang tersimpan
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $adminUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
$adminPage = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

echo "Admin page HTTP code: {$info['http_code']}\n";
echo "--- Admin page snippet ---\n";
echo substr($adminPage ?? '', 0, 800) . "\n";

if (file_exists($cookieFile)) {
    unlink($cookieFile);
}
