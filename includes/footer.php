<footer class="main-footer bg-white border-top-0 text-slate-400 text-sm p-6">
        <div class="float-right d-none d-sm-inline">
            SmartLMS <span class="text-indigo-600 font-bold">v2.0</span>
        </div>
        <strong>&copy; 2026.</strong> Built with ❤️ for better education.
    </footer>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables otomatis untuk semua tabel dengan class .datatable
        $('.datatable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "zeroRecords": "Data tidak ditemukan",
                "info": "Menampilkan _PAGE_ dari _PAGES_",
                "paginate": {
                    "next": "Lanjut",
                    "previous": "Kembali"
                }
            }
        });

        // Notifikasi Sukses via URL Parameter
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('status') && urlParams.get('status') === 'sukses') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data telah disimpan/diperbarui.',
                timer: 2000,
                showConfirmButton: false,
                borderRadius: '20px'
            });
        }
    });
</script>
</body>
</html>