<?php include '../includes/header_siswa.php'; ?>

<div class="content-wrapper pt-8 px-6 bg-slate-50">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-800">Tugas Saya</h1>
        <p class="text-slate-500">Selesaikan tugas tepat waktu untuk hasil maksimal.</p>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <?php
        // Query untuk mengambil tugas kelas siswa dan mengecek apakah sudah dikumpulkan
        $q = mysqli_query($conn, "SELECT t.*, p.status as status_kumpul, p.nilai, p.tgl_kumpul, p.catatan_guru 
                        FROM tugas t 
                        LEFT JOIN pengumpulan p ON t.id_tugas = p.id_tugas AND p.id_siswa = '$id_siswa'
                        WHERE t.id_kelas = '$id_kelas_siswa' 
                        ORDER BY t.deadline ASC");
        
        while($d = mysqli_fetch_assoc($q)):
            $is_submitted = !empty($d['status_kumpul']);
            $deadline_timestamp = strtotime($d['deadline']);
            $is_expired = $deadline_timestamp < time();
        ?>
        <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <h3 class="text-xl font-bold text-slate-800"><?= $d['judul_tugas'] ?></h3>
                    <?php if($is_submitted): ?>
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-full text-xs font-bold">Terkirim</span>
                    <?php elseif($is_expired): ?>
                        <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-bold">Terlambat</span>
                    <?php else: ?>
                        <span class="px-3 py-1 bg-amber-100 text-amber-600 rounded-full text-xs font-bold">Belum Dikerjakan</span>
                    <?php endif; ?>
                </div>
                <p class="text-slate-500 text-sm mb-4"><?= substr($d['deskripsi_tugas'], 0, 150) ?>...</p>
                <div class="flex flex-wrap gap-4 text-xs font-semibold uppercase tracking-wider text-slate-400">
                    <span><i class="far fa-calendar-alt mr-1"></i> Deadline: <?= date('d M Y, H:i', $deadline_timestamp) ?></span>
                    <?php if($is_submitted): ?>
                        <span class="text-indigo-600"><i class="fas fa-check-circle mr-1"></i> Dikumpul: <?= date('d M, H:i', strtotime($d['tgl_kumpul'])) ?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-center min-w-[150px]">
    <?php if($is_submitted): ?>
        <div class="mb-2">
            <span class="text-xs text-slate-400 font-bold uppercase">Nilai Anda</span>
            <h4 class="text-4xl font-black text-indigo-600"><?= $d['nilai'] ?? '--' ?></h4>
        </div>
        
        <?php if(!empty($d['catatan_guru'])): ?>
            <div class="mt-4 p-3 bg-indigo-50 rounded-xl border border-indigo-100">
                <p class="text-[10px] font-bold text-indigo-400 uppercase tracking-tighter">Catatan Guru:</p>
                <p class="text-xs text-indigo-700 italic">"<?= $d['catatan_guru'] ?>"</p>
            </div>
        <?php endif; ?>
        
    <?php elseif(!$is_expired): ?>
        <button data-toggle="modal" data-target="#modalTugas<?= $d['id_tugas'] ?>" 
                class="bg-indigo-600 text-white px-8 py-4 rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">
            Kerjakan
        </button>
    <?php else: ?>
        <span class="text-red-400 font-bold">Waktu Habis</span>
    <?php endif; ?>
</div>
        </div>

        <div class="modal fade" id="modalTugas<?= $d['id_tugas'] ?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-[2.5rem] border-none shadow-2xl overflow-hidden">
                    <div class="bg-indigo-600 p-8 text-white">
                        <h3 class="text-2xl font-black">Kirim Jawaban</h3>
                        <p class="text-indigo-100 text-sm"><?= $d['judul_tugas'] ?></p>
                    </div>
                    <form action="proses_tugas.php" method="POST" enctype="multipart/form-data" class="p-8">
                        <input type="hidden" name="id_tugas" value="<?= $d['id_tugas'] ?>">
                        <div class="space-y-4">
                            <textarea name="jawaban_teks" rows="4" placeholder="Tulis catatan atau jawaban singkat di sini..." class="w-full p-4 bg-slate-100 rounded-2xl border-none outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                            <div class="p-6 border-2 border-dashed border-slate-200 rounded-2xl text-center">
                                <input type="file" name="file_tugas" id="file<?= $d['id_tugas'] ?>" class="hidden" required>
                                <label for="file<?= $d['id_tugas'] ?>" class="cursor-pointer">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-indigo-400 mb-2"></i>
                                    <p class="text-slate-500 text-sm">Upload File Jawaban (PDF/DOC/ZIP)</p>
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="w-full mt-8 bg-indigo-600 text-white py-4 rounded-2xl font-bold">Kirim Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
