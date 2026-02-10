<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartLMS - Future of Learning</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .blob { position: absolute; width: 500px; height: 500px; background: rgba(79, 70, 229, 0.15); filter: blur(80px); border-radius: 50%; z-index: -1; }
    </style>
</head>
<body class="bg-slate-50 overflow-x-hidden">
    <div class="blob -top-20 -left-20"></div>
    <div class="blob bottom-0 -right-20 bg-indigo-200/30"></div>

    <div class="min-h-screen flex flex-col lg:flex-row items-center justify-center p-6 gap-12 max-w-7xl mx-auto">
        <div class="lg:w-1/2 text-center lg:text-left">
            <span class="px-4 py-2 bg-indigo-100 text-indigo-600 rounded-full text-sm font-bold tracking-wide uppercase">New Version 2.0</span>
            <h1 class="text-5xl lg:text-7xl font-extrabold text-slate-900 mt-6 leading-tight">
                Belajar Tanpa <span class="text-indigo-600">Batas.</span>
            </h1>
            <p class="text-slate-500 mt-6 text-lg max-w-md mx-auto lg:mx-0">
                Sistem Manajemen Pembelajaran terintegrasi untuk Guru, Siswa, dan Admin dalam satu platform modern.
            </p>
        </div>

        <div class="lg:w-1/2 w-full max-w-md">
            <div class="bg-white/80 backdrop-blur-xl p-10 rounded-[2.5rem] shadow-2xl shadow-indigo-100 border border-white">
                <div class="mb-10 text-center">
                    <h2 class="text-3xl font-bold text-slate-800">Selamat Datang</h2>
                    <p class="text-slate-400 mt-2">Masuk dengan akun Anda</p>
                </div>

                <form action="auth/login_process.php" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                        <input type="text" name="username" required
                            class="w-full px-5 py-4 rounded-2xl bg-slate-100/50 border-none focus:ring-2 focus:ring-indigo-500 transition-all outline-none"
                            placeholder="username_anda">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-5 py-4 rounded-2xl bg-slate-100/50 border-none focus:ring-2 focus:ring-indigo-500 transition-all outline-none"
                            placeholder="••••••••">
                    </div>
                    <button type="submit" 
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-5 rounded-2xl shadow-lg shadow-indigo-200 transition-all transform hover:scale-[1.02] active:scale-95">
                        Masuk Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>

    // Alert Handler
<?php if(isset($_GET['pesan'])): ?>
    <?php if($_GET['pesan'] == 'gagal'): ?>
        Swal.fire({ icon: 'error', title: 'Login Gagal', text: 'Username atau Password salah!', borderRadius: '20px' });
    <?php elseif($_GET['pesan'] == 'logout'): ?>
        Swal.fire({ icon: 'success', title: 'Berhasil Keluar', text: 'Sampai jumpa kembali!', timer: 2000, showConfirmButton: false, borderRadius: '20px' });
    <?php endif; ?>
<?php endif; ?>
</body>
</html>