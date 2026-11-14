<?php
require_once 'config.php'; require_login();
$sum=db()->query("SELECT COALESCE(SUM(CASE WHEN jenis='masuk' THEN nominal ELSE -nominal END),0) saldo,
COALESCE(SUM(CASE WHEN jenis='masuk' THEN nominal ELSE 0 END),0) masuk,
COALESCE(SUM(CASE WHEN jenis='keluar' THEN nominal ELSE 0 END),0) keluar FROM transaksi")->fetch();
$recent=db()->query('SELECT * FROM transaksi ORDER BY tanggal DESC,id DESC LIMIT 10')->fetchAll();
require 'includes/header.php';
?>
<div class="cards">
<div class="card"><small>Total Pemasukan</small><div class="metric"><?=rupiah($sum['masuk'])?></div></div>
<div class="card"><small>Total Pengeluaran</small><div class="metric"><?=rupiah($sum['keluar'])?></div></div>
<div class="card"><small>Saldo Kas</small><div class="metric"><?=rupiah($sum['saldo'])?></div></div>
</div>
<div class="card"><h2>Transaksi Terbaru</h2><div class="wrap"><table><tr><th>Tanggal</th><th>Uraian</th><th>Jenis</th><th>Nominal</th></tr>
<?php foreach($recent as $t):?><tr><td><?=e($t['tanggal'])?></td><td><?=e($t['uraian'])?></td><td><?=e($t['jenis'])?></td><td><?=rupiah($t['nominal'])?></td></tr><?php endforeach;?>
</table></div><p><a class="btn" href="transaksi.php">Kelola Transaksi</a></p></div>
<?php require 'includes/footer.php'; ?>
