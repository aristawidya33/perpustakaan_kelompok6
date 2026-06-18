<?php
include "../../config/koneksi.php";

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

<!DOCTYPE html>
<html>
<head>
<title>Laporan Denda</title>

<style>
body{
    font-family: 'Segoe UI', sans-serif;
    background: #f3f7ff;
    margin: 0;
    padding: 0;
}

.container{
    width: 95%;
    margin: 30px auto;
}

.header{
    background: #1e5eff;
    color: white;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    font-size: 22px;
    font-weight: bold;
}

/* NAV */
.toolbar{
    margin-top: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn{
    text-decoration: none;
    padding: 10px 14px;
    border-radius: 8px;
    font-weight: bold;
}

.btn-back{
    background: white;
    color: #1e5eff;
    border: 2px solid #1e5eff;
}

.btn-back:hover{
    background: #1e5eff;
    color: white;
}

.btn-print{
    background: #1e5eff;
    color: white;
    border: none;
    cursor: pointer;
}

.btn-print:hover{
    background: #003ecc;
}

/* FILTER CARD */
.card{
    margin-top: 20px;
    background: white;
    padding: 15px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,255,0.08);
}

form select{
    padding: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
    margin-right: 10px;
}

form button{
    padding: 8px 12px;
    background: #1e5eff;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

form button:hover{
    background: #003ecc;
}

/* TABLE */
table{
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th{
    background: #e8f0ff;
    color: #1e5eff;
    padding: 12px;
    border-bottom: 2px solid #1e5eff;
}

td{
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

tr:hover{
    background: #f2f7ff;
}

/* SUMMARY */
.summary{
    margin-top: 15px;
    padding: 15px;
    background: #1e5eff;
    color: white;
    border-radius: 10px;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
}

.denda{
    color: #ff3b3b;
    font-weight: bold;
}

</style>

</head>
<body>

<div class="container">

    <div class="header">
        💰 Laporan Denda Perpustakaan
    </div>

    <div class="toolbar">

        <a href="../dashboard.php" class="btn btn-back">
            ← Dashboard
        </a>

        <a
href="export_denda.php?bulan=<?= isset($_GET['bulan']) ? $_GET['bulan'] : '' ?>&tahun=<?= isset($_GET['tahun']) ? $_GET['tahun'] : '' ?>"
class="btn btn-print">

📊 Export Excel

</a>

    </div>

    <div class="card">

        <form method="GET">

            📅 Bulan :
            <select name="bulan">
                <option value="">Semua</option>
                <?php for($i=1;$i<=12;$i++){ ?>
                <option value="<?= $i ?>"
                    <?= (isset($_GET['bulan']) && $_GET['bulan']==$i) ? 'selected' : '' ?>>
                    <?= $i ?>
                </option>
                <?php } ?>
            </select>

            📆 Tahun :
            <select name="tahun">
                <option value="">Semua</option>
                <?php for($t=2024;$t<=2035;$t++){ ?>
                <option value="<?= $t ?>"
                    <?= (isset($_GET['tahun']) && $_GET['tahun']==$t) ? 'selected' : '' ?>>
                    <?= $t ?>
                </option>
                <?php } ?>
            </select>

            <button type="submit">Tampilkan</button>

        </form>

        <table>

            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Judul Buku</th>
                <th>Tanggal Kembali</th>
                <th>Lama Pinjam</th>
                <th>Denda</th>
            </tr>

            <?php $no=1; while($d=mysqli_fetch_assoc($data)){ ?>

            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['nim']; ?></td>
                <td><?= $d['nama_anggota']; ?></td>
                <td><?= $d['judul_buku']; ?></td>
                <td><?= $d['tanggal_kembali']; ?></td>
                <td><?= $d['lama_pinjam']; ?> Hari</td>
                <td class="denda">
                    Rp <?= number_format($d['denda']); ?>
                </td>
            </tr>

            <?php } ?>

        </table>

    </div>

    <div class="summary">
        💰 Total Denda: Rp <?= number_format($hasil['total_denda']); ?>
    </div>

</div>

</body>
</html>