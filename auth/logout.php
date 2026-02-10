<?php
session_start();

// Hapus semua data di session
$_SESSION = array();

// Jika ingin benar-benar menghancurkan session cookie, lakukan ini
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hancurkan session
session_destroy();

// Arahkan kembali ke halaman login dengan parameter status
header("Location: ../index.php?pesan=logout");
exit;