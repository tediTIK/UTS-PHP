<?php require_once __DIR__.'/../config.php'; require_login(); ?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Kas Mushola / Masjid</title>
<style>
*{box-sizing:border-box}body{margin:0;background:#f3f7f4;font-family:Arial,sans-serif;color:#173c2b}
header{background:#176b45;color:white;padding:18px 5%;display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap}
header a{color:white;text-decoration:none;margin-left:12px}main{max-width:1100px;margin:22px auto;padding:0 15px}
.card{background:#fff;padding:18px;border-radius:12px;margin-bottom:16px;box-shadow:0 2px 10px #0000000a}
.cards{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}.metric{font-size:24px;font-weight:bold;margin-top:8px}
label{display:block;margin:9px 0 5px}input,select{padding:10px;border:1px solid #cbd8cf;border-radius:7px;width:100%}
button,.btn{display:inline-block;background:#176b45;color:white;border:0;border-radius:7px;padding:10px 14px;text-decoration:none;cursor:pointer}
.btn.gray{background:#e7f1ea;color:#176b45}.btn.red{background:#b63838}
table{border-collapse:collapse;width:100%;min-width:700px}th,td{border:1px solid #dce5df;padding:9px;text-align:left}th{background:#d8efdf}.wrap{overflow-x:auto}
.grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}.msg{padding:10px;background:#fff4d5;border-radius:8px}
@media(max-width:700px){.cards,.grid{grid-template-columns:1fr}}
@media print{header,.no-print{display:none}body{background:white}.card{box-shadow:none}}
</style></head><body>
<header><div><b>🕌 Kas Mushola / Masjid</b><br><small>Halo, <?=e($_SESSION['nama'] ?? 'Bendahara')?> (<?=e($_SESSION['role'] ?? '')?>)</small></div>
<nav><a href="index.php">Dashboard</a><a href="transaksi.php">Transaksi</a><a href="logout.php">Keluar</a></nav></header><main>
