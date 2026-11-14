<?php
require_once 'config.php'; require_login();
$edit=null; $msg='';
if(isset($_GET['edit'])){$s=db()->prepare('SELECT * FROM transaksi WHERE id=?');$s->execute([(int)$_GET['edit']]);$edit=$s->fetch();}
if($_SERVER['REQUEST_METHOD']==='POST'){
 $id=(int)($_POST['id']??0);$tanggal=$_POST['tanggal'];$jenis=$_POST['jenis'];$uraian=trim($_POST['uraian']);$kategori=$_POST['kategori'];$nominal=(int)$_POST['nominal'];$metode=$_POST['metode'];
 if($nominal>0 && in_array($jenis,['masuk','keluar'],true)){
  if($id){$s=db()->prepare('UPDATE transaksi SET tanggal=?,jenis=?,uraian=?,kategori=?,nominal=?,metode=? WHERE id=?');$s->execute([$tanggal,$jenis,$uraian,$kategori,$nominal,$metode,$id]);}
  else{$s=db()->prepare('INSERT INTO transaksi(tanggal,jenis,uraian,kategori,nominal,metode,user_id) VALUES(?,?,?,?,?,?,?)');$s->execute([$tanggal,$jenis,$uraian,$kategori,$nominal,$metode,$_SESSION['user_id']]);}
  header('Location: transaksi.php?saved=1');exit;
 } else $msg='Nominal harus lebih dari nol.';
}
if(isset($_GET['hapus'])){if(($_SESSION['role']??'')==='admin'){$s=db()->prepare('DELETE FROM transaksi WHERE id=?');$s->execute([(int)$_GET['hapus']]);}header('Location: transaksi.php');exit;}
$month=$_GET['bulan']??'';$kind=$_GET['jenis']??'';
$sql='SELECT * FROM transaksi WHERE 1=1';$args=[];
if($month){$sql.=' AND DATE_FORMAT(tanggal,"%Y-%m")=?';$args[]=$month;}
if($kind){$sql.=' AND jenis=?';$args[]=$kind;}
$sql.=' ORDER BY tanggal DESC,id DESC';
$s=db()->prepare($sql);$s->execute($args);$list=$s->fetchAll();
require 'includes/header.php';
?>
<div class="card"><h2><?= $edit?'Edit Transaksi':'Tambah Transaksi'?></h2>
<?php if($msg):?><p class="msg"><?=e($msg)?></p><?php endif;?>
<form method="post"><input type="hidden" name="id" value="<?=e($edit['id']??'')?>">
<div class="grid">
<div><label>Tanggal</label><input type="date" name="tanggal" value="<?=e($edit['tanggal']??date('Y-m-d'))?>" required></div>
<div><label>Jenis</label><select name="jenis"><option value="masuk" <?=($edit['jenis']??'')==='masuk'?'selected':''?>>Pemasukan</option><option value="keluar" <?=($edit['jenis']??'')==='keluar'?'selected':''?>>Pengeluaran</option></select></div>
<div><label>Kategori</label><select name="kategori"><?php foreach(['Infak','Infaq Jumat','Donasi','Bisyaroh','Konsumsi','Perlengkapan','Operasional','Listrik/Air','Pembangunan','Lain-lain'] as $c):?><option <?=($edit['kategori']??'')===$c?'selected':''?>><?=e($c)?></option><?php endforeach;?></select></div>
<div><label>Uraian</label><input name="uraian" value="<?=e($edit['uraian']??'')?>" required></div>
<div><label>Nominal (Rp)</label><input type="number" min="1" name="nominal" value="<?=e($edit['nominal']??'')?>" required></div>
<div><label>Metode / lokasi uang</label><select name="metode"><?php foreach(['Kas Tunai','Rekening Bank','Di Bendahara'] as $m):?><option <?=($edit['metode']??'')===$m?'selected':''?>><?=e($m)?></option><?php endforeach;?></select></div>
</div><p><button>Simpan</button> <a class="btn gray" href="transaksi.php">Reset</a></p></form></div>
<div class="card"><div class="no-print"><h2>Daftar Transaksi</h2><form method="get" class="grid"><div><label>Filter bulan</label><input type="month" name="bulan" value="<?=e($month)?>"></div><div><label>Jenis</label><select name="jenis"><option value="">Semua</option><option value="masuk" <?=$kind==='masuk'?'selected':''?>>Pemasukan</option><option value="keluar" <?=$kind==='keluar'?'selected':''?>>Pengeluaran</option></select></div><div style="align-self:end"><button>Filter</button> <a class="btn gray" href="transaksi.php">Reset</a> <button type="button" onclick="window.print()" class="btn gray">Cetak</button></div></form></div>
<div class="wrap"><table><tr><th>Tanggal</th><th>Uraian</th><th>Kategori</th><th>Jenis</th><th>Metode</th><th>Nominal</th><th class="no-print">Aksi</th></tr>
<?php foreach($list as $t):?><tr><td><?=e($t['tanggal'])?></td><td><?=e($t['uraian'])?></td><td><?=e($t['kategori'])?></td><td><?=e($t['jenis'])?></td><td><?=e($t['metode'])?></td><td><?=rupiah($t['nominal'])?></td><td class="no-print"><a class="btn gray" href="?edit=<?=$t['id']?>">Edit</a> <?php if(($_SESSION['role']??'')==='admin'):?><a class="btn red" onclick="return confirm('Hapus transaksi?')" href="?hapus=<?=$t['id']?>">Hapus</a><?php endif;?></td></tr><?php endforeach;?>
</table></div></div>
<?php require 'includes/footer.php'; ?>
