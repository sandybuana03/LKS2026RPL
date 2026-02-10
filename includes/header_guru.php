<?php
session_start();
if($_SESSION['role'] != 'guru') header("Location: ../index.php");
include '../config/koneksi.php';
$id_guru = $_SESSION['id_user'];
$id_kelas_guru = $_SESSION['id_kelas'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guru Panel | SmartLMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed bg-slate-50">
<div class="wrapper">
    <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-indigo-950">
        <div class="p-6 text-white font-bold text-xl flex items-center gap-2">
            <div class="bg-indigo-600 p-2 rounded-lg"><i class="fas fa-chalkboard-teacher"></i></div> GuruPanel
        </div>
        <div class="sidebar px-4">
            <nav class="mt-4">
                <ul class="nav nav-pills nav-sidebar flex-column gap-2">
                    <li class="nav-item"><a href="dashboard.php" class="nav-link active rounded-xl"><i class="nav-icon fas fa-home"></i> <p>Dashboard</p></a></li>
                    <li class="nav-item"><a href="materi.php" class="nav-link rounded-xl"><i class="nav-icon fas fa-book"></i> <p>Upload Materi</p></a></li>
                    <li class="nav-item"><a href="tugas.php" class="nav-link rounded-xl"><i class="nav-icon fas fa-tasks"></i> <p>Kelola Tugas</p></a></li>
                    <li class="nav-item"><a href="nilai.php" class="nav-link rounded-xl"><i class="nav-icon fas fa-star"></i> <p>Penilaian</p></a></li>
                    <li class="nav-item mt-4 border-t border-indigo-800 pt-4"><a href="../auth/logout.php" class="nav-link text-red-400"><i class="nav-icon fas fa-power-off"></i> <p>Logout</p></a></li>
                </ul>
            </nav>
        </div>
    </aside>