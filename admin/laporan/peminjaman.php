<?php
include "../../config/koneksi.php";

$where = "";

if(
    isset($_GET['bulan']) &&
    isset($_GET['tahun']) &&
    $_GET['bulan'] != "" &&
    $_GET['tahun'] != ""
){
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];

    $where = "
    WHERE MONTH(tanggal_pinjam)='$bulan'
    AND YEAR(tanggal_pinjam)='$tahun'
    ";
}

$data = mysqli_query($conn,"
SELECT *
FROM v_buku
$where
ORDER BY id_peminjaman DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Laporan Peminjaman</title>

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

/* HEADER */
.header{
    background: #1e5eff;
    color: white;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    font-size: 22px;
    font-weight: bold;
}

/* TOOLBAR */
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
    border: none;
    cursor: pointer;
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

/* STATUS */
.status{
    padding: 5px 10px;
    border-radius: 6px;
    font-size: 12px;
    display: inline-block;
    background: #dbe9ff;
    color: #1e5eff;
}

/* PERIODE */
.periode{
    margin-top: 10px;
    padding: 10px;
    background: #1e5eff;
    color: white;
    border-radius: 8px;
    display: inline-block;
}

</style>

</head>
<body>

<div class="container">

    <div class="header">
        📚 Laporan Peminjaman Buku
    </div>

    <div class="toolbar">

        <a href="../dashboard.php" class="btn btn-back">
            ← Dashboard
        </a>

        <a
            href="export_excel.php?bulan=<?= isset($_GET['bulan']) ? $_GET['bulan'] : '' ?>&tahun=<?= isset($_GET['tahun']) ? $_GET['tahun'] : '' ?>"
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

        <?php if(isset($_GET['bulan']) && isset($_GET['tahun']) && $_GET['bulan'] != "" && $_GET['tahun'] != ""){ ?>
            <div class="periode">
                📌 Periode: <?= $_GET['bulan']; ?> / <?= $_GET['tahun']; ?>
            </div>
        <?php } ?>

        <table>

            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>

            <?php $no=1; while($d=mysqli_fetch_assoc($data)){ ?>

            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['nim']; ?></td>
                <td><?= $d['nama_anggota']; ?></td>
                <td><?= $d['judul_buku']; ?></td>
                <td><?= $d['tanggal_pinjam']; ?></td>
                <td>
                    <span class="status"><?= $d['status']; ?></span>
                </td>
            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>