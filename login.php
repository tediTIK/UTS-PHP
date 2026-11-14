<?php
require_once 'config.php';
if (!empty($_SESSION['user_id'])) { header('Location: index.php'); exit; }
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
  $stmt=db()->prepare('SELECT id,nama,username,password_hash,role FROM users WHERE username=?');
  $stmt->execute([trim($_POST['username'] ?? '')]); $u=$stmt->fetch();
  if ($u && password_verify($_POST['password'] ?? '', $u['password_hash'])) {
    session_regenerate_id(true); $_SESSION['user_id']=$u['id']; $_SESSION['nama']=$u['nama']; $_SESSION['role']=$u['role'];
    header('Location: index.php'); exit;
  } else $error='Username atau password salah.';
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Login Kas Mushola</title>
<style>body{font-family:Arial;background:#eaf3ed;display:grid;place-items:center;min-height:100vh}.box{background:white;padding:28px;border-radius:14px;width:min(380px,92vw)}input{width:100%;padding:11px;margin:8px 0;border:1px solid #ccd8d0;border-radius:7px}button{background:#176b45;color:white;border:0;padding:11px;width:100%;border-radius:7px}.err{color:#b22}</style></head><body><div class="box">
<h2>🕌 Login Bendahara</h2><p>Aplikasi Kas Mushola / Masjid</p><?php if($error):?><p class="err"><?=e($error)?></p><?php endif;?>
<form method="post"><label>Username</label><input name="username" required><label>Password</label><input name="password" type="password" required><button>Masuk</button></form>
</div></body></html>
