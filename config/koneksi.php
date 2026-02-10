<?php
// Pengaturan Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "LKS2026"; // Pastikan nama ini sama dengan yang dibuat di SQL Step 2

$conn = mysqli_connect($host, $user, $pass, $db);

// Verifikasi Koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Pengaturan URL Dasar (Sesuaikan dengan nama folder proyek Anda di htdocs)
// Gunakan trailing slash '/' di akhir
$base_url = "http://localhost/LKS2026/"; 

// Pengaturan Timezone (Penting untuk deadline tugas)
date_default_timezone_set("Asia/Jakarta");
?>