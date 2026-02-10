<?php include '../includes/header_admin.php'; ?>

<div class="content-wrapper pt-8 px-6 bg-slate-50">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Kelas</h1>
            <p class="text-slate-500">Ruang lingkup untuk pengelompokan guru dan siswa.</p>
        </div>
        <button data-toggle="modal" data-target="#addKelas" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold shadow-lg shadow-indigo-100 transition-all">
            <i class="fas fa-plus mr-2"></i> Tambah Kelas
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        $q = mysqli_query($conn, "SELECT k.*, 
            (SELECT COUNT(*) FROM users WHERE id_kelas = k.id_kelas AND role='siswa') as total_siswa,
            (SELECT nama_lengkap FROM users WHERE id_kelas = k.id_kelas AND role='guru' LIMIT 1) as nama_guru
            FROM kelas k");
        while($d = mysqli_fetch_assoc($q)):
        ?>
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/40 border border-white p-8 hover:scale-[1.02] transition-all group">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-xl font-black group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    <?= substr($d['nama_kelas'], 0, 1) ?>
                </div>
                <a href="proses_kelas.php?aksi=hapus&id=<?= $d['id_kelas'] ?>" class="text-slate-300 hover:text-red-500 transition-colors" onclick="return confirm('Hapus kelas ini?')">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
            
            <h3 class="text-xl font-bold text-slate-800 mb-1"><?= $d['nama_kelas'] ?></h3>
            <p class="text-sm font-mono text-slate-400 mb-6 tracking-widest uppercase">ID: <?= $d['kode_kelas'] ?></p>
            
            <div class="space-y-3">
                <div class="flex items-center gap-3 text-sm text-slate-600">
                    <i class="fas fa-chalkboard-teacher w-5 text-indigo-400"></i>
                    <span>Guru: <b class="text-slate-800"><?= $d['nama_guru'] ?? 'Belum ada' ?></b></span>
                </div>
                <div class="flex items-center gap-3 text-sm text-slate-600">
                    <i class="fas fa-user-graduate w-5 text-indigo-400"></i>
                    <span>Siswa: <b class="text-slate-800"><?= $d['total_siswa'] ?> Orang</b></span>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<div class="modal fade" id="addKelas">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-[2.5rem] border-none shadow-2xl">
            <div class="bg-indigo-600 p-8 text-white">
                <h3 class="text-2xl font-black">Buat Kelas Baru</h3>
                <p class="text-indigo-100 text-sm">Gunakan kode unik untuk setiap kelas.</p>
            </div>
            <form action="proses_kelas.php?aksi=tambah" method="POST" class="p-8 space-y-4">
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase ml-2">Nama Kelas</label>
                    <input type="text" name="nama" placeholder="Contoh: Web Development 101" class="w-full p-4 bg-slate-100 rounded-2xl border-none mt-1 outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-400 uppercase ml-2">Kode Kelas</label>
                    <input type="text" name="kode" placeholder="Contoh: WEB-01" class="w-full p-4 bg-slate-100 rounded-2xl border-none mt-1 outline-none focus:ring-2 focus:ring-indigo-500" required>
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-bold shadow-lg shadow-indigo-100 mt-4">Simpan Kelas</button>
            </form>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>