<?php include '../includes/header_siswa.php'; ?>

<div class="content-wrapper pt-8 px-6 bg-slate-50">
    <div class="mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">Materi Kelas</h1>
            <p class="text-slate-500">Pelajari modul yang telah disiapkan oleh Guru Anda.</p>
        </div>
        <div class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-xl text-sm font-bold">
            <i class="fas fa-book mr-2"></i> Sumber Belajar Terintegrasi
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        // Query hanya mengambil materi yang id_kelas-nya sama dengan id_kelas siswa
        $q = mysqli_query($conn, "SELECT m.*, u.nama_lengkap as nama_guru 
                                FROM materi m 
                                JOIN users u ON m.id_guru = u.id_user 
                                WHERE m.id_kelas = '$id_kelas_siswa' 
                                ORDER BY m.created_at DESC");
        
        if (mysqli_num_rows($q) == 0) {
            echo '<div class="col-span-full bg-white p-20 rounded-[3rem] text-center border-2 border-dashed border-slate-200">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" class="w-32 mx-auto mb-6 opacity-20" alt="empty">
                    <h3 class="text-xl font-bold text-slate-400">Belum ada materi untuk kelas ini.</h3>
                  </div>';
        }

        while($d = mysqli_fetch_assoc($q)):
        ?>
        <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-indigo-100/50 transition-all group">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-xl group-hover:bg-indigo-600 group-hover:text-white transition-all">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-300 bg-slate-50 px-3 py-1 rounded-full">
                    <?= date('d M Y', strtotime($d['created_at'])) ?>
                </span>
            </div>

            <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-indigo-600 transition-colors">
                <?= $d['judul'] ?>
            </h3>
            
            <p class="text-slate-500 text-sm mb-6 line-clamp-3 leading-relaxed">
                <?= strip_tags($d['konten']) ?>
            </p>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center text-[10px] font-bold text-slate-500">
                    <?= substr($d['nama_guru'], 0, 1) ?>
                </div>
                <span class="text-xs font-semibold text-slate-400">Oleh: <b class="text-slate-600"><?= $d['nama_guru'] ?></b></span>
            </div>

            <div class="flex gap-2">
                <button data-toggle="modal" data-target="#viewMateri<?= $d['id_materi'] ?>" 
                        class="flex-1 bg-slate-900 text-white py-3 rounded-2xl text-sm font-bold hover:bg-slate-800 transition-all">
                    Baca Detail
                </button>
                <?php if($d['file_path']): ?>
                <a href="../uploads/<?= $d['file_path'] ?>" target="_blank" 
                   class="w-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center hover:bg-indigo-600 hover:text-white transition-all">
                    <i class="fas fa-download"></i>
                </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="modal fade" id="viewMateri<?= $d['id_materi'] ?>">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-[2.5rem] border-none shadow-2xl overflow-hidden">
                    <div class="bg-indigo-600 p-8 text-white relative">
                        <h3 class="text-2xl font-black mb-1"><?= $d['judul'] ?></h3>
                        <p class="text-indigo-100 text-sm opacity-80 italic">Oleh: <?= $d['nama_guru'] ?></p>
                        <i class="fas fa-book-open absolute right-8 top-8 text-6xl opacity-20"></i>
                    </div>
                    <div class="p-10">
                        <div class="prose max-w-none text-slate-600 leading-relaxed mb-8">
                            <?= nl2br($d['konten']) ?>
                        </div>
                        <?php if($d['file_path']): ?>
                            <div class="bg-slate-50 p-6 rounded-3xl border border-slate-100 flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    <i class="fas fa-file-pdf text-3xl text-red-500"></i>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">Dokumen Pendukung</p>
                                        <p class="text-xs text-slate-400">Klik unduh untuk menyimpan file materi.</p>
                                    </div>
                                </div>
                                <a href="../uploads/<?= $d['file_path'] ?>" target="_blank" class="bg-white border border-slate-200 px-6 py-3 rounded-2xl text-sm font-bold shadow-sm hover:bg-indigo-600 hover:text-white transition-all">
                                    Unduh File
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>