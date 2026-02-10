<?php
session_start();
include_once __DIR__ . '/../config/koneksi.php';

if($_SESSION['role'] != 'admin') exit;

$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kode = mysqli_real_escape_string($conn, $_POST['kode']);

    $sql = "INSERT INTO kelas (nama_kelas, kode_kelas) VALUES ('$nama', '$kode')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: kelas.php?status=sukses");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if ($aksi == 'hapus') {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM kelas WHERE id_kelas = '$id'");
    header("Location: kelas.php?status=sukses");
}
?>