<?php include '../includes/header_admin.php'; ?>

<div class="content-wrapper pt-8 px-6 bg-slate-50">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-extrabold text-slate-800 mb-2">Statistik Sistem</h1>
        <p class="text-slate-500 mb-8">Pantau seluruh aktivitas pengguna dan kelas.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-white">
                <div class="bg-indigo-50 w-14 h-14 rounded-2xl flex items-center justify-center text-indigo-600 text-2xl mb-6">
                    <i class="fas fa-user-tie"></i>
                </div>
                <?php $g = mysqli_query($conn, "SELECT count(*) as total FROM users WHERE role='guru'"); $dg = mysqli_fetch_assoc($g); ?>
                <h3 class="text-4xl font-black text-slate-800"><?= $dg['total'] ?></h3>
                <p class="text-slate-500 font-semibold mt-1 uppercase tracking-wider text-xs">Total Guru Terdaftar</p>
            </div>

            <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-white">
                <div class="bg-emerald-50 w-14 h-14 rounded-2xl flex items-center justify-center text-emerald-600 text-2xl mb-6">
                    <i class="fas fa-users"></i>
                </div>
                <?php $s = mysqli_query($conn, "SELECT count(*) as total FROM users WHERE role='siswa'"); $ds = mysqli_fetch_assoc($s); ?>
                <h3 class="text-4xl font-black text-slate-800"><?= $ds['total'] ?></h3>
                <p class="text-slate-500 font-semibold mt-1 uppercase tracking-wider text-xs">Total Siswa Aktif</p>
            </div>

            <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-slate-200/50 border border-white">
                <div class="bg-orange-50 w-14 h-14 rounded-2xl flex items-center justify-center text-orange-600 text-2xl mb-6">
                    <i class="fas fa-door-open"></i>
                </div>
                <?php $k = mysqli_query($conn, "SELECT count(*) as total FROM kelas"); $dk = mysqli_fetch_assoc($k); ?>
                <h3 class="text-4xl font-black text-slate-800"><?= $dk['total'] ?></h3>
                <p class="text-slate-500 font-semibold mt-1 uppercase tracking-wider text-xs">Kelas Tersedia</p>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>