<?php include '../includes/header_siswa.php'; ?>

<div class="content-wrapper pt-8 px-6 bg-slate-50">
    <div class="relative overflow-hidden bg-indigo-600 rounded-[3rem] p-10 mb-8 shadow-2xl shadow-indigo-200">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="text-white text-center md:text-left">
                <h1 class="text-4xl font-black mb-2 tracking-tight">Halo, <?= $_SESSION['nama'] ?>! 👋</h1>
                <?php 
                    $q_k = mysqli_query($conn, "SELECT nama_kelas FROM kelas WHERE id_kelas = '$id_kelas_siswa'");
                    $dk = mysqli_fetch_assoc($q_k);
                ?>
                <p class="text-indigo-100 text-lg">Kamu sedang belajar di kelas <span class="font-bold border-b-2 border-indigo-400"><?= $dk['nama_kelas'] ?? 'Umum' ?></span></p>
            </div>
            <div class="bg-white/10 backdrop-blur-md p-4 rounded-3xl border border-white/20 text-center text-white min-w-[150px]">
                <p class="text-xs font-bold uppercase tracking-widest opacity-80">Skor Rata-rata</p>
                <?php 
                    $q_avg = mysqli_query($conn, "SELECT AVG(nilai) as rata FROM pengumpulan WHERE id_siswa = '$id_siswa'");
                    $d_avg = mysqli_fetch_assoc($q_avg);
                ?>
                <h2 class="text-4xl font-black"><?= number_format($d_avg['rata'] ?? 0, 1) ?></h2>
            </div>
        </div>
        <i class="fas fa-rocket absolute -right-10 -bottom-10 text-[15rem] text-indigo-500/20 rotate-12"></i>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex items-center gap-6 group hover:border-indigo-200 transition-all">
            <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-blue-600 group-hover:text-white transition-all">
                <i class="fas fa-book-open"></i>
            </div>
            <div>
                <?php $m = mysqli_query($conn, "SELECT count(*) as total FROM materi WHERE id_kelas = '$id_kelas_siswa'"); $dm = mysqli_fetch_assoc($m); ?>
                <h3 class="text-3xl font-black text-slate-800"><?= $dm['total'] ?></h3>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Materi Tersedia</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex items-center gap-6 group hover:border-orange-200 transition-all">
            <div class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-orange-600 group-hover:text-white transition-all">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <?php 
                $t = mysqli_query($conn, "SELECT count(*) as total FROM tugas WHERE id_kelas = '$id_kelas_siswa' AND id_tugas NOT IN (SELECT id_tugas FROM pengumpulan WHERE id_siswa = '$id_siswa')"); 
                $dt = mysqli_fetch_assoc($t); 
                ?>
                <h3 class="text-3xl font-black text-slate-800"><?= $dt['total'] ?></h3>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Tugas Belum Selesai</p>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 flex items-center gap-6 group hover:border-emerald-200 transition-all">
            <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-emerald-600 group-hover:text-white transition-all">
                <i class="fas fa-star"></i>
            </div>
            <div>
                <?php $n = mysqli_query($conn, "SELECT count(*) as total FROM pengumpulan WHERE id_siswa = '$id_siswa' AND status = 'dinilai'"); $dn = mysqli_fetch_assoc($n); ?>
                <h3 class="text-3xl font-black text-slate-800"><?= $dn['total'] ?></h3>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Tugas Telah Dinilai</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
        <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
            <i class="fas fa-bullhorn text-indigo-600"></i> Info Penting
        </h3>
        <div class="p-6 bg-slate-50 rounded-3xl border border-slate-100">
            <p class="text-slate-600 italic">Selamat datang di sistem pembelajaran modern. Pastikan kamu mengecek menu materi secara berkala dan mengumpulkan tugas sebelum deadline berakhir!</p>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>