<?php
session_start();
// Menggunakan __DIR__ untuk mencari folder config yang naik satu tingkat dari folder auth
require_once __DIR__ . '/../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sekarang $conn sudah terdefinisi dari file koneksi.php
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['id_user']  = $user['id_user'];
            $_SESSION['nama']     = $user['nama_lengkap'];
            $_SESSION['role']     = $user['role'];
            $_SESSION['id_kelas'] = $user['id_kelas'];
            $_SESSION['status']   = "login";

            // Redirect berdasarkan Role ke folder masing-masing
            if ($user['role'] == 'admin') {
                header("Location: ../super-admin/dashboard.php");
            } elseif ($user['role'] == 'guru') {
                header("Location: ../guru/dashboard.php");
            } elseif ($user['role'] == 'siswa') {
                header("Location: ../siswa/dashboard.php");
            }
            exit;
        }
    }
    header("Location: ../index.php?pesan=gagal");
}
?>