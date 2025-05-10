<?php
// Pastikan ini adalah file PHP yang dapat diakses di server lokal Anda
$password = '111'; // Ganti dengan password yang ingin Anda hash
$hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Menghasilkan hash dari password

echo "Hashed Password: " . $hashedPassword; // Menampilkan hash
?>