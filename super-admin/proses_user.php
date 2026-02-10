<?php
session_start();
include_once __DIR__ . '/../config/koneksi.php';

if($_SESSION['role'] != 'admin') exit;

$aksi = $_GET['aksi'];

// TAMBAH USER (GURU / SISWA)
if ($aksi == 'tambah_guru' || $aksi == 'tambah_siswa') {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $id_kelas = $_POST['id_kelas'];
    $role     = ($aksi == 'tambah_guru') ? 'guru' : 'siswa';

    $sql = "INSERT INTO users (username, password, nama_lengkap, role, id_kelas) 
            VALUES ('$username', '$password', '$nama', '$role', '$id_kelas')";
    
    if (mysqli_query($conn, $sql)) {
        $redirect = ($role == 'guru') ? 'guru.php' : 'siswa.php';
        header("Location: $redirect?status=sukses");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// HAPUS USER
if ($aksi == 'hapus') {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id_user = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: " . $_SERVER['HTTP_REFERER'] . "?status=sukses");
    }
}
?>