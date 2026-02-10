<?php
session_start();
include_once __DIR__ . '/../config/koneksi.php';

if($_SESSION['role'] != 'guru') exit;

$id_guru = $_SESSION['id_user'];
$id_kelas = $_SESSION['id_kelas'];
$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $konten = mysqli_real_escape_string($conn, $_POST['konten']);
    
    // Upload File
    $filename = $_FILES['lampiran']['name'];
    if($filename != "") {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $new_name = "materi_".time().".".$ext;
        move_uploaded_file($_FILES['lampiran']['tmp_name'], "../uploads/".$new_name);
    } else {
        $new_name = null;
    }

    $sql = "INSERT INTO materi (id_kelas, id_guru, judul, konten, file_path) 
            VALUES ('$id_kelas', '$id_guru', '$judul', '$konten', '$new_name')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: materi.php?status=sukses");
    }
}

if ($aksi == 'hapus') {
    $id = $_GET['id'];
    // Hapus file fisiknya juga agar tidak memenuhi server
    $q_file = mysqli_query($conn, "SELECT file_path FROM materi WHERE id_materi = '$id'");
    $df = mysqli_fetch_assoc($q_file);
    if($df['file_path']) unlink("../uploads/".$df['file_path']);

    mysqli_query($conn, "DELETE FROM materi WHERE id_materi = '$id'");
    header("Location: materi.php?status=sukses");
}
?>