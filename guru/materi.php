<?php include '../includes/header_guru.php'; ?>

<div class="content-wrapper pt-8 px-6 bg-slate-50">
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">Materi Kuliah</h1>
            <p class="text-slate-500">Kelola bahan ajar untuk kelas Anda.</p>
        </div>
        <button data-toggle="modal" data-target="#addMateri" class="bg-indigo-600 text-white px-8 py-4 rounded-2xl font-bold shadow-lg">
            <i class="fas fa-plus mr-2"></i> Tambah Materi
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <table class="table table-borderless align-middle datatable">
            <thead class="bg-slate-50">
                <tr class="text-slate-400 text-xs font-bold uppercase tracking-widest">
                    <th class="p-4">Judul Materi</th>
                    <th>File Lampiran</th>
                    <th>Tanggal Upload</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q = mysqli_query($conn, "SELECT * FROM materi WHERE id_guru = '$id_guru' ORDER BY created_at DESC");
                while($d = mysqli_fetch_assoc($q)):
                ?>
                <tr class="border-b border-slate-50">
                    <td class="p-4 font-bold text-slate-700"><?= $d['judul'] ?></td>
                    <td>
                        <?php if($d['file_path']): ?>
                            <a href="../uploads/<?= $d['file_path'] ?>" class="text-indigo-600 text-sm font-bold" target="_blank">
                                <i class="fas fa-download mr-1"></i> Lihat File
                            </a>
                        <?php else: ?>
                            <span class="text-slate-300 text-xs italic">No File</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-slate-500 text-sm"><?= date('d M Y', strtotime($d['created_at'])) ?></td>
                    <td class="text-center">
                        <a href="proses_materi.php?aksi=hapus&id=<?= $d['id_materi'] ?>" class="text-red-400 p-2" onclick="return confirm('Hapus materi ini?')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addMateri">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-[2.5rem] border-none shadow-2xl">
            <form action="proses_materi.php?aksi=tambah" method="POST" enctype="multipart/form-data" class="p-8">
                <h3 class="text-2xl font-black mb-6">Upload Materi Baru</h3>
                <div class="space-y-4">
                    <input type="text" name="judul" placeholder="Judul Materi (Misal: Dasar HTML)" class="w-full p-4 bg-slate-50 rounded-2xl border-none outline-none focus:ring-2 focus:ring-indigo-500" required>
                    <textarea name="konten" rows="5" placeholder="Tulis instruksi atau ringkasan materi di sini..." class="w-full p-4 bg-slate-50 rounded-2xl border-none outline-none focus:ring-2 focus:ring-indigo-500" required></textarea>
                    <div class="p-6 border-2 border-dashed border-slate-200 rounded-2xl text-center">
                        <input type="file" name="lampiran" id="file" class="hidden">
                        <label for="file" class="cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-4xl text-indigo-400 mb-2"></i>
                            <p class="text-slate-500 text-sm">Klik untuk upload PDF atau Gambar Materi</p>
                        </label>
                    </div>
                </div>
                <button type="submit" class="w-full mt-8 bg-indigo-600 text-white py-4 rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">Terbitkan Materi</button>
            </form>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>