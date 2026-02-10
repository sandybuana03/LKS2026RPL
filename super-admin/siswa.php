<?php include '../includes/header_admin.php'; ?>

<div class="content-wrapper pt-8 px-6 bg-slate-50">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Manajemen Siswa</h1>
            <p class="text-slate-500">Daftar siswa yang terdaftar di sistem.</p>
        </div>
        <button data-toggle="modal" data-target="#addSiswa" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl font-bold shadow-lg shadow-indigo-100 transition-all">
            <i class="fas fa-plus mr-2"></i> Tambah Siswa
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 p-6 border border-white overflow-hidden">
        <table class="table table-borderless align-middle datatable">
            <thead>
                <tr class="text-slate-400 text-xs font-bold uppercase tracking-widest border-b border-slate-100">
                    <th class="p-4">Nama Lengkap</th>
                    <th>Username</th>
                    <th>Kelas Diampu</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = mysqli_query($conn, "SELECT users.*, kelas.nama_kelas FROM users LEFT JOIN kelas ON users.id_kelas = kelas.id_kelas WHERE role='siswa'");
                while($d = mysqli_fetch_assoc($q)):
                ?>
                <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                    <td class="p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold text-xs"><?= substr($d['nama_lengkap'], 0, 2) ?></div>
                            <span class="font-bold text-slate-700"><?= $d['nama_lengkap'] ?></span>
                        </div>
                    </td>
                    <td class="text-slate-500 font-medium"><?= $d['username'] ?></td>
                    <td><span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-xs font-bold border border-indigo-100"><?= $d['nama_kelas'] ?? 'Belum Mapping' ?></span></td>
                    <td class="text-center">
                        <a href="proses_user.php?aksi=hapus&id=<?= $d['id_user'] ?>" class="text-red-400 hover:text-red-600 p-2" onclick="return confirm('Hapus siswa ini?')"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addSiswa">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-[2.5rem] border-none shadow-2xl overflow-hidden">
            <div class="bg-indigo-600 p-8 text-white">
                <h3 class="text-2xl font-black">Tambah Siswa</h3>
                <p class="text-indigo-100 text-sm">Daftarkan siswa baru ke sistem.</p>
            </div>
            <form action="proses_user.php?aksi=tambah_siswa" method="POST" class="p-8 space-y-4">
                <input type="text" name="nama" placeholder="Nama Lengkap" class="w-full p-4 bg-slate-100 rounded-2xl border-none outline-none focus:ring-2 focus:ring-indigo-500" required>
                <input type="text" name="username" placeholder="Username" class="w-full p-4 bg-slate-100 rounded-2xl border-none outline-none focus:ring-2 focus:ring-indigo-500" required>
                <input type="password" name="password" placeholder="Password" class="w-full p-4 bg-slate-100 rounded-2xl border-none outline-none focus:ring-2 focus:ring-indigo-500" required>
                <select name="id_kelas" class="w-full p-4 bg-slate-100 rounded-2xl border-none outline-none" required>
                    <option value="">Pilih Kelas</option>
                    <?php $k = mysqli_query($conn, "SELECT * FROM kelas"); while($dk = mysqli_fetch_assoc($k)) echo "<option value='".$dk['id_kelas']."'>".$dk['nama_kelas']."</option>"; ?>
                </select>
                <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">Simpan Data</button>
            </form>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>