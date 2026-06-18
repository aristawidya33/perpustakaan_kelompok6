<?php
include "../../config/koneksi.php";

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

if(!$data){
    die(mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Laporan Buku Terlaris</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Segoe UI',sans-serif;
    background:#f3f7ff;
    padding:30px;
}

.container{
    max-width:1200px;
    margin:auto;
}

.header{
    background:linear-gradient(135deg,#1e5eff,#4a8cff);
    color:white;
    padding:25px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,255,.15);
}

.header h1{
    font-size:28px;
}

.header p{
    margin-top:8px;
    opacity:.9;
}

.card{
    margin-top:20px;
    background:white;
    border-radius:15px;
    padding:20px;
    box-shadow:0 5px 15px rgba(0,0,255,.08);
}

.toolbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:10px;
}

form{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    align-items:center;
}

select{
    padding:10px;
    border:1px solid #ccc;
    border-radius:8px;
    min-width:120px;
}

.btn{
    text-decoration:none;
    padding:10px 15px;
    border-radius:8px;
    font-weight:bold;
    display:inline-block;
}

.btn-filter{
    background:#1e5eff;
    color:white;
    border:none;
    cursor:pointer;
}

.btn-filter:hover{
    background:#0046d5;
}

.btn-export{
    background:#28a745;
    color:white;
}

.btn-export:hover{
    background:#218838;
}

.btn-back{
    background:white;
    color:#1e5eff;
    border:2px solid #1e5eff;
}

.btn-back:hover{
    background:#1e5eff;
    color:white;
}

.table-container{
    margin-top:20px;
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#1e5eff;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    border-bottom:1px solid #eee;
    text-align:center;
}

tr:hover{
    background:#f0f6ff;
}

.rank{
    background:#dbe9ff;
    color:#1e5eff;
    padding:5px 10px;
    border-radius:20px;
    font-weight:bold;
}

.total{
    font-weight:bold;
    color:#28a745;
}

.footer{
    margin-top:20px;
    text-align:center;
}

@media(max-width:768px){

    .toolbar{
        flex-direction:column;
        align-items:stretch;
    }

    form{
        flex-direction:column;
        align-items:stretch;
    }

}

</style>
</head>
<body>

<div class="container">

    <div class="header">
        <h1>🏆 Laporan Buku Terlaris</h1>
        <p>Daftar Buku yang Paling Banyak Dipinjam</p>
    </div>

    <div class="card">

        <div class="toolbar">

            <form method="GET">

                <label>Bulan</label>

                <select name="bulan">
                    <option value="">Semua</option>

                    <?php
                    for($i=1;$i<=12;$i++){
                    ?>
                    <option value="<?= $i ?>"
                    <?= ($bulan==$i)?'selected':'' ?>>
                        <?= $i ?>
                    </option>
                    <?php } ?>

                </select>

                <label>Tahun</label>

                <select name="tahun">
                    <option value="">Semua</option>

                    <?php
                    for($i=date('Y');$i>=2020;$i--){
                    ?>
                    <option value="<?= $i ?>"
                    <?= ($tahun==$i)?'selected':'' ?>>
                        <?= $i ?>
                    </option>
                    <?php } ?>

                </select>

                <button class="btn btn-filter" type="submit">
                    🔍 Filter
                </button>

            </form>

            <div>

                <a
                href="export_buku_terlaris.php?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>"
                class="btn btn-export">
                    📊 Export Excel
                </a>

                <a
                href="../dashboard.php"
                class="btn btn-back">
                    ← Dashboard
                </a>

            </div>

        </div>

        <div class="table-container">

            <table>

                <tr>
                    <th>Ranking</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Total Dipinjam</th>
                </tr>

                <?php
                $no = 1;

                while($d=mysqli_fetch_array($data)){
                ?>

                <tr>

                    <td>
                        <span class="rank">
                            #<?= $no++; ?>
                        </span>
                    </td>

                    <td>
                        <?= $d['judul_buku']; ?>
                    </td>

                    <td>
                        <?= $d['pengarang']; ?>
                    </td>

                    <td class="total">
                        <?= $d['total_pinjam']; ?> Kali
                    </td>

                </tr>

                <?php } ?>

            </table>

        </div>

    </div>

    <div class="footer">
        Sistem Informasi Perpustakaan © <?= date('Y'); ?>
    </div>

</div>

</body>
</html>