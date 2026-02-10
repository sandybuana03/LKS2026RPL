<?php
session_start();
include_once __DIR__ . '/../config/koneksi.php';

if($_SESSION['role'] != 'siswa') exit;

$id_siswa = $_SESSION['id_user'];
$id_tugas = $_POST['id_tugas'];
$jawaban  = mysqli_real_escape_string($conn, $_POST['jawaban_teks']);

// Upload File Siswa
$filename = $_FILES['file_tugas']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
$new_name = "tugas_".$id_tugas."_".$id_siswa."_".time().".".$ext;

if(move_uploaded_file($_FILES['file_tugas']['tmp_name'], "../uploads/".$new_name)) {
    $sql = "INSERT INTO pengumpulan (id_tugas, id_siswa, jawaban_teks, file_siswa, status) 
            VALUES ('$id_tugas', '$id_siswa', '$jawaban', '$new_name', 'dikirim')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: tugas.php?status=sukses");
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
} else {
    echo "Gagal upload file.";
}
?>