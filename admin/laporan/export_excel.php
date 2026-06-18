<?php

include "../../config/koneksi.php";

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Peminjaman.xls");

$data = mysqli_query($conn,"
SELECT
    anggota.nim,
    anggota.nama_anggota,
    buku.judul_buku,
    peminjaman.tanggal_pinjam,
    peminjaman.tanggal_kembali,
    peminjaman.status
FROM peminjaman
JOIN anggota
ON anggota.id_anggota=peminjaman.id_anggota
JOIN buku
ON buku.id_buku=peminjaman.id_buku
ORDER BY peminjaman.id_peminjaman DESC
");

?>

<h2>Laporan Peminjaman Buku</h2>

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
$no=1;

while($d=mysqli_fetch_array($data)){
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