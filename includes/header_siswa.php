<?php
session_start();
// Proteksi halaman: Jika bukan siswa atau belum login, tendang ke login
if (!isset($_SESSION['status']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../index.php?pesan=belum_login");
    exit;
}

include_once __DIR__ . '/../config/koneksi.php';

$id_siswa = $_SESSION['id_user'];
$id_kelas_siswa = $_SESSION['id_kelas'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siswa Panel | SmartLMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .content-wrapper { background: #f8fafc !important; }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white border-0 shadow-sm">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item px-3 text-slate-500 font-semibold">
                <i class="far fa-user-circle mr-1"></i> <?= $_SESSION['nama'] ?>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-slate-900">
        <div class="p-6 flex items-center gap-3">
            <div class="bg-indigo-600 p-2 rounded-xl text-white shadow-lg shadow-indigo-500/50">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <span class="text-white font-extrabold text-xl tracking-tight">SmartLMS</span>
        </div>
        <div class="sidebar px-4">
            <nav class="mt-4">
                <ul class="nav nav-pills nav-sidebar flex-column gap-2" data-widget="treeview">
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link active rounded-xl py-3">
                            <i class="nav-icon fas fa-th-large"></i> <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="materi.php" class="nav-link rounded-xl py-3">
                            <i class="nav-icon fas fa-book-open"></i> <p>Materi Kelas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="tugas.php" class="nav-link rounded-xl py-3">
                            <i class="nav-icon fas fa-tasks"></i> <p>Tugas & Nilai</p>
                        </a>
                    </li>
                    <li class="nav-item mt-8 border-t border-slate-700 pt-4">
                        <a href="../auth/logout.php" class="nav-link text-red-400">
                            <i class="nav-icon fas fa-power-off"></i> <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>