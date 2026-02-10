<?php
session_start();
include_once __DIR__ . '/../config/koneksi.php';

if($_SESSION['role'] != 'guru') exit;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pengumpulan = $_POST['id_pengumpulan'];
    $nilai          = $_POST['nilai'];
    $catatan        = mysqli_real_escape_string($conn, $_POST['catatan']);

    // Update nilai, catatan, dan ubah status menjadi 'dinilai'
    $sql = "UPDATE pengumpulan SET 
            nilai = '$nilai', 
            catatan_guru = '$catatan', 
            status = 'dinilai' 
            WHERE id_pengumpulan = '$id_pengumpulan'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: nilai.php?status=sukses");
    } else {
        echo "Gagal: " . mysqli_error($conn);
    }
}
?>