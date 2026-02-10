<?php include '../includes/header_guru.php'; ?>

<div class="content-wrapper pt-8 px-6 bg-slate-50">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-800">Penilaian Tugas</h1>
        <p class="text-slate-500">Evaluasi jawaban siswa dan berikan nilai terbaik.</p>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <table class="table table-borderless align-middle datatable">
            <thead class="bg-slate-50">
                <tr class="text-slate-400 text-xs font-bold uppercase tracking-widest">
                    <th class="p-4">Siswa</th>
                    <th>Judul Tugas</th>
                    <th>Tgl Kumpul</th>
                    <th>Status</th>
                    <th>Nilai</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan semua pengumpulan tugas dari siswa yang ada di kelas guru tersebut
                $q = mysqli_query($conn, "SELECT p.*, u.nama_lengkap, t.judul_tugas 
                                        FROM pengumpulan p 
                                        JOIN users u ON p.id_siswa = u.id_user 
                                        JOIN tugas t ON p.id_tugas = t.id_tugas 
                                        WHERE t.id_guru = '$id_guru'
                                        ORDER BY p.tgl_kumpul DESC");
                
                while($d = mysqli_fetch_assoc($q)):
                ?>
                <tr class="border-b border-slate-50">
                    <td class="p-4 font-bold text-slate-700"><?= $d['nama_lengkap'] ?></td>
                    <td class="text-slate-500"><?= $d['judul_tugas'] ?></td>
                    <td class="text-xs text-slate-400"><?= date('d/m/y H:i', strtotime($d['tgl_kumpul'])) ?></td>
                    <td>
                        <?php if($d['status'] == 'dinilai'): ?>
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-lg text-xs font-bold">Selesai</span>
                        <?php else: ?>
                            <span class="px-3 py-1 bg-amber-100 text-amber-600 rounded-lg text-xs font-bold">Perlu Dinilai</span>
                        <?php endif; ?>
                    </td>
                    <td class="font-black text-indigo-600"><?= $d['nilai'] ?? '-' ?></td>
                    <td class="text-center">
                        <button data-toggle="modal" data-target="#modalNilai<?= $d['id_pengumpulan'] ?>" 
                                class="bg-slate-900 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-indigo-600 transition-all">
                            Periksa & Nilai
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="modalNilai<?= $d['id_pengumpulan'] ?>">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-[2.5rem] border-none shadow-2xl overflow-hidden">
                            <div class="bg-slate-900 p-8 text-white">
                                <h3 class="text-xl font-black">Evaluasi Tugas</h3>
                                <p class="text-slate-400 text-sm"><?= $d['nama_lengkap'] ?> - <?= $d['judul_tugas'] ?></p>
                            </div>
                            <form action="proses_nilai.php" method="POST" class="p-8">
                                <input type="hidden" name="id_pengumpulan" value="<?= $d['id_pengumpulan'] ?>">
                                
                                <div class="mb-6">
                                    <label class="text-xs font-bold text-slate-400 uppercase">Jawaban Siswa:</label>
                                    <div class="p-4 bg-slate-50 rounded-2xl text-sm text-slate-600 mt-2 italic">
                                        <?= nl2br($d['jawaban_teks']) ?>
                                    </div>
                                    <?php if($d['file_siswa']): ?>
                                        <a href="../uploads/<?= $d['file_siswa'] ?>" target="_blank" class="inline-block mt-3 text-indigo-600 font-bold text-xs border-b border-indigo-200 pb-1">
                                            <i class="fas fa-file-download mr-1"></i> Lihat File Jawaban
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <label class="text-xs font-bold text-slate-400 uppercase ml-2">Input Nilai (0-100)</label>
                                        <input type="number" name="nilai" min="0" max="100" value="<?= $d['nilai'] ?>" class="w-full p-4 bg-slate-100 rounded-2xl border-none mt-1 outline-none focus:ring-2 focus:ring-indigo-500" required>
                                    </div>
                                    <div>
                                        <label class="text-xs font-bold text-slate-400 uppercase ml-2">Catatan Guru</label>
                                        <textarea name="catatan" rows="3" class="w-full p-4 bg-slate-100 rounded-2xl border-none mt-1 outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Contoh: Kerja bagus, tingkatkan lagi!"><?= $d['catatan_guru'] ?></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="w-full mt-8 bg-indigo-600 text-white py-4 rounded-2xl font-bold shadow-lg">Simpan Nilai</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>