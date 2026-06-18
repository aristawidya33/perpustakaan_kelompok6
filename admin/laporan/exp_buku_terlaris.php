<?php

include "../../config/koneksi.php";

header("Content-Type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Buku_Terlaris.xls");

$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';

$where = "";

if($bulan != "" && $tahun != ""){

    $where = "
    WHERE MONTH(p.tanggal_pinjam)='$bulan'
    AND YEAR(p.tanggal_pinjam)='$tahun'
    ";

}

$data = mysqli_query($conn,"
SELECT
    b.judul_buku,
    b.pengarang,
    COUNT(p.id_buku) AS total_pinjam
FROM peminjaman p
JOIN buku b ON p.id_buku=b.id_buku
$where
GROUP BY p.id_buku
ORDER BY total_pinjam DESC
");

?>

<h2>Laporan Buku Terlaris</h2>

<?php if($bulan != "" && $tahun != ""){ ?>

<p>
Periode : <?= $bulan ?> / <?= $tahun ?>
</p>

<?php } ?>

<table border="1">

<tr>
    <th>Ranking</th>
    <th>Judul Buku</th>
    <th>Pengarang</th>
    <th>Total Dipinjam</th>
</tr>

<?php

$no = 1;

while($d = mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $d['judul_buku']; ?></td>

<td><?= $d['pengarang']; ?></td>

<td><?= $d['total_pinjam']; ?> Kali</td>

</tr>

<?php } ?>

</table>