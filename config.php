<?php
// Sesuaikan dengan konfigurasi MySQL di komputer/server Anda.
define('DB_HOST', 'localhost');
define('DB_NAME', 'kas_mushola');
define('DB_USER', 'root');
define('DB_PASS', '');

session_start();

function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        $pdo = new PDO(
            'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',
            DB_USER, DB_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
             PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
        );
    }
    return $pdo;
}
function rupiah($n): string { return 'Rp '.number_format((float)$n, 0, ',', '.'); }
function e($s): string { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function require_login(): void {
    if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }
}
