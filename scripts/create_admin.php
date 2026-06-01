<?php
require_once __DIR__ . '/../src/Auth.php';

// Skrip singkat untuk membuat akun admin dengan kredensial yang diketahui.
// Cara pakai (di terminal): php scripts/create_admin.php

try {
    $auth = new App\Auth(__DIR__ . '/../data/user.json');
    $email = 'admin@local';
    $password = 'admin123';
    $nama = 'Administrator';

    // Cek apakah sudah ada
    $users = $auth->getAllUsers();
    foreach ($users as $u) {
        if ($u['email'] === $email) {
            echo "User admin sudah ada: $email\n";
            exit(0);
        }
    }

    $auth->register($nama, $email, $password, 'admin');
    echo "Akun admin berhasil dibuat:\nEmail: $email\nPassword: $password\n";
} catch (Exception $e) {
    echo "Gagal membuat admin: " . $e->getMessage() . "\n";
}
