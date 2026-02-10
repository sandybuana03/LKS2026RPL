<?php include '../includes/header_guru.php'; ?>

<div class="content-wrapper pt-8 px-6 bg-slate-50">
    <?php 
    $q_kelas = mysqli_query($conn, "SELECT nama_kelas FROM kelas WHERE id_kelas = '$id_kelas_guru'");
    $d_kelas = mysqli_fetch_assoc($q_kelas);
    ?>
    <h1 class="text-3xl font-extrabold text-slate-800">Halo, <?= $_SESSION['nama'] ?>!</h1>
    <p class="text-slate-500 mb-8">Mengajar di Kelas: <span class="badge badge-primary"><?= $d_kelas['nama_kelas'] ?></span></p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-6">
            <div class="bg-blue-50 w-16 h-16 rounded-2xl flex items-center justify-center text-blue-600 text-2xl"><i class="fas fa-user-graduate"></i></div>
            <div>
                <?php $s = mysqli_query($conn, "SELECT count(*) as total FROM users WHERE role='siswa' AND id_kelas='$id_kelas_guru'"); $ds = mysqli_fetch_assoc($s); ?>
                <h3 class="text-3xl font-bold"><?= $ds['total'] ?></h3>
                <p class="text-slate-500 uppercase text-xs tracking-widest font-bold">Siswa di Kelas Anda</p>
            </div>
        </div>
        
        <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100 flex items-center gap-6">
            <div class="bg-orange-50 w-16 h-16 rounded-2xl flex items-center justify-center text-orange-600 text-2xl"><i class="fas fa-clipboard-list"></i></div>
            <div>
                <?php $t = mysqli_query($conn, "SELECT count(*) as total FROM pengumpulan p JOIN tugas tg ON p.id_tugas=tg.id_tugas WHERE tg.id_guru='$id_guru' AND p.status='dikirim'"); $dt = mysqli_fetch_assoc($t); ?>
                <h3 class="text-3xl font-bold"><?= $dt['total'] ?></h3>
                <p class="text-slate-500 uppercase text-xs tracking-widest font-bold">Tugas Belum Dinilai</p>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>