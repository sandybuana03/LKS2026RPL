<?php include '../includes/header_guru.php'; ?>

<div class="content-wrapper pt-8 px-6 bg-slate-50">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">Tugas Kelas</h1>
            <p class="text-slate-500">Berikan tantangan untuk menguji pemahaman siswa.</p>
        </div>
        <button data-toggle="modal" data-target="#addTugas" class="bg-indigo-600 text-white px-8 py-4 rounded-2xl font-bold shadow-lg">
            <i class="fas fa-plus mr-2"></i> Buat Tugas Baru
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <table class="table table-borderless align-middle datatable">
            <thead class="bg-slate-50">
                <tr class="text-slate-400 text-xs font-bold uppercase tracking-widest">
                    <th class="p-4">Judul Tugas</th>
                    <th>Deadline</th>
                    <th>Terkumpul</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = mysqli_query($conn, "SELECT t.*, 
                    (SELECT COUNT(*) FROM pengumpulan WHERE id_tugas = t.id_tugas) as jumlah_kumpul 
                    FROM tugas t WHERE t.id_guru = '$id_guru' ORDER BY t.deadline ASC");
                while($d = mysqli_fetch_assoc($q)):
                    $is_expired = strtotime($d['deadline']) < time();
                ?>
                <tr class="border-b border-slate-50">
                    <td class="p-4 font-bold text-slate-700"><?= $d['judul_tugas'] ?></td>
                    <td>
                        <span class="px-3 py-1 rounded-lg text-xs font-bold <?= $is_expired ? 'bg-red-50 text-red-500' : 'bg-emerald-50 text-emerald-600' ?>">
                            <i class="far fa-clock mr-1"></i> <?= date('d M, H:i', strtotime($d['deadline'])) ?>
                        </span>
                    </td>
                    <td><span class="badge badge-pill badge-light text-indigo-600 font-bold"><?= $d['jumlah_kumpul'] ?> Siswa</span></td>
                    <td class="text-center">
                        <a href="proses_tugas.php?aksi=hapus&id=<?= $d['id_tugas'] ?>" class="text-red-400 p-2" onclick="return confirm('Hapus tugas ini?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addTugas">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-[2.5rem] border-none shadow-2xl">
            <form action="proses_tugas.php?aksi=tambah" method="POST" class="p-8">
                <h3 class="text-2xl font-black mb-6">Buat Tugas Baru</h3>
                <div class="space-y-4">
                    <input type="text" name="judul" placeholder="Judul Tugas (Contoh: Membuat Layout CSS Grid)" class="w-full p-4 bg-slate-50 rounded-2xl border-none outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <textarea name="deskripsi" rows="4" placeholder="Detail instruksi pengerjaan tugas..." class="w-full p-4 bg-slate-50 rounded-2xl border-none outline-none focus:ring-2 focus:ring-indigo-500" required></textarea>
                    
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase ml-2">Batas Waktu (Deadline)</label>
                        <input type="datetime-local" name="deadline" class="w-full p-4 bg-slate-50 rounded-2xl border-none mt-1 outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>
                </div>
                <button type="submit" class="w-full mt-8 bg-indigo-600 text-white py-4 rounded-2xl font-bold shadow-lg shadow-indigo-100">Publikasikan Tugas</button>
            </form>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>