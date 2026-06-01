<?php
// Login lalu ambil /debug_session.php menggunakan cookie untuk menampilkan isi session
$loginUrl = 'http://localhost:8000/login.php';
$debugUrl = 'http://localhost:8000/debug_session.php';
$cookieFile = __DIR__ . '/cookie_debug.txt';

// Login
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
$resp = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

echo "Login HTTP code: {$info['http_code']}\n";

// Ambil debug_session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $debugUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
$debug = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

echo "Debug session HTTP code: {$info['http_code']}\n";
echo "--- debug_session output ---\n";
echo $debug . "\n";

if (file_exists($cookieFile)) unlink($cookieFile);
