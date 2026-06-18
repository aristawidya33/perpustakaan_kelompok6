<?php

include "../../config/koneksi.php";

header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Pengembalian.xls");

$where = "WHERE status='dikembalikan'";

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

?>

<h2>Laporan Pengembalian Buku</h2>

<table border="1">

<tr>
    <th>No</th>
    <th>NIM</th>
    <th>Nama</th>
    <th>Judul Buku</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Status</th>
</tr>

<?php
$no = 1;

while($d = mysqli_fetch_assoc($data)){
?>

<tr>
    <td><?= $no++; ?></td>
    <td><?= $d['nim']; ?></td>
    <td><?= $d['nama_anggota']; ?></td>
    <td><?= $d['judul_buku']; ?></td>
    <td><?= $d['tanggal_pinjam']; ?></td>
    <td><?= $d['tanggal_kembali']; ?></td>
    <td><?= $d['status']; ?></td>
</tr>

<?php } ?>

</table>