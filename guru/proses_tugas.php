<?php
session_start();
include_once __DIR__ . '/../config/koneksi.php';

if($_SESSION['role'] != 'guru') exit;

$id_guru = $_SESSION['id_user'];
$id_kelas = $_SESSION['id_kelas'];
$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $desc  = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $dl    = $_POST['deadline'];

    $sql = "INSERT INTO tugas (id_kelas, id_guru, judul_tugas, deskripsi_tugas, deadline) 
            VALUES ('$id_kelas', '$id_guru', '$judul', '$desc', '$dl')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: tugas.php?status=sukses");
    }
}

if ($aksi == 'hapus') {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM tugas WHERE id_tugas = '$id'");
    header("Location: tugas.php?status=sukses");
}
?>