<?php

include "../../config/koneksi.php";

header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Denda.xls");

$where = "WHERE denda > 0";

if(
    isset($_GET['bulan']) &&
    isset($_GET['tahun']) &&
    $_GET['bulan'] != "" &&
    $_GET['tahun'] != ""
){

    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];

    $where .= "
    AND MONTH(tanggal_kembali)='$bulan'
    AND YEAR(tanggal_kembali)='$tahun'
    ";
}

$data = mysqli_query($conn,"
SELECT *
FROM v_buku
$where
ORDER BY id_peminjaman DESC
");

$total = mysqli_query($conn,"
SELECT SUM(denda) AS total_denda
FROM v_buku
$where
");

$hasil = mysqli_fetch_assoc($total);

?>

<h2>Laporan Denda Perpustakaan</h2>

<?php if(isset($bulan) && isset($tahun)){ ?>

<p>
Periode : <?= $bulan ?> / <?= $tahun ?>
</p>

<?php } ?>

<table border="1">

<tr>
    <th>No</th>
    <th>NIM</th>
    <th>Nama</th>
    <th>Judul Buku</th>
    <th>Tanggal Kembali</th>
    <th>Lama Pinjam</th>
    <th>Denda</th>
</tr>

<?php
$no=1;

while($d=mysqli_fetch_assoc($data)){
?>

<tr>

<td><?= $no++; ?></td>
<td><?= $d['nim']; ?></td>
<td><?= $d['nama_anggota']; ?></td>
<td><?= $d['judul_buku']; ?></td>
<td><?= $d['tanggal_kembali']; ?></td>
<td><?= $d['lama_pinjam']; ?> Hari</td>
<td>Rp <?= number_format($d['denda']); ?></td>

</tr>

<?php } ?>

<tr>

<td colspan="6">
<b>Total Denda</b>
</td>

<td>
<b>
Rp <?= number_format($hasil['total_denda']); ?>
</b>
</td>

</tr>

</table>