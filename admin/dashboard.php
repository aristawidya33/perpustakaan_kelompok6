```php
<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['role'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

// Total Anggota
$qAnggota = mysqli_query($conn,"SELECT COUNT(*) AS total FROM anggota");
$anggota = mysqli_fetch_assoc($qAnggota);

// Total Buku
$qBuku = mysqli_query($conn,"SELECT COUNT(*) AS total FROM buku");
$buku = mysqli_fetch_assoc($qBuku);

// Total Peminjaman
$qPinjam = mysqli_query($conn,"SELECT COUNT(*) AS total FROM peminjaman");
$peminjaman = mysqli_fetch_assoc($qPinjam);

// Total Mahasiswa
$qMhs = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM users
WHERE role='mahasiswa'
");
$mahasiswa = mysqli_fetch_assoc($qMhs);

// Total Pengembalian
$qKembali = mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM peminjaman
WHERE status='dikembalikan'
");
$pengembalian = mysqli_fetch_assoc($qKembali);

// Buku Terlaris
$qTerlaris = mysqli_query($conn,"
SELECT
    buku.judul_buku,
    COUNT(*) AS total
FROM peminjaman
JOIN buku
ON buku.id_buku = peminjaman.id_buku
GROUP BY peminjaman.id_buku
ORDER BY total DESC
LIMIT 1
");

$terlaris = mysqli_fetch_assoc($qTerlaris);

if(!$terlaris){
    $terlaris['judul_buku'] = "Belum Ada";
    $terlaris['total'] = 0;
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dashboard Admin</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Segoe UI',sans-serif;
    background:#f4f6f9;
}

.sidebar{
    position:fixed;
    left:0;
    top:0;
    width:220px;
    height:100%;
    background:linear-gradient(
        180deg,
        #007bff,
        #00bcd4
    );
    color:white;
}

.sidebar h2{
    text-align:center;
    padding:25px;
    border-bottom:1px solid rgba(255,255,255,.2);
}

.sidebar a{
    display:block;
    color:white;
    text-decoration:none;
    padding:15px 20px;
}

.sidebar a:hover{
    background:rgba(255,255,255,.2);
}

.content{
    margin-left:220px;
    padding:15px;
}

.header{
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 3px 10px rgba(0,0,0,.1);
}

.container{
    margin-top:20px;
    display:grid;
    grid-template-columns:
    repeat(auto-fit,minmax(180px,1fr));
    gap:15px;
}

.card{
    background:white;
    border-radius:12px;
    padding:15px;
    text-align:center;
    box-shadow:0 3px 10px rgba(0,0,0,.1);
}

.card h2{
    color:#007bff;
    font-size:30px;
}

.card p{
    margin-top:10px;
    color:#666;
}

.card small{
    display:block;
    margin-top:8px;
    color:#888;
}

.grafik{
    margin-top:30px;
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 3px 10px rgba(0,0,0,.1);
}

#grafikPerpus{
    height:250px !important;
}

.footer{
    text-align:center;
    margin-top:25px;
    color:#666;
}

@media(max-width:768px){

    .sidebar{
        width:100%;
        height:auto;
        position:relative;
    }

    .content{
        margin-left:0;
    }

}

</style>

</head>

<body>

<div class="sidebar">

    <h2>📚 PERPUSTAKAAN</h2>

    <a href="dashboard.php">🏠 Dashboard</a>

    <a href="anggota/index.php">👥 Data Anggota</a>

    <a href="buku/index.php">📖 Data Buku</a>

    <a href="laporan/peminjaman.php">
        📋 Laporan Peminjaman
    </a>

    <a href="laporan/pengembalian.php">
        🔄 Laporan Pengembalian
    </a>

    <a href="laporan/denda.php">
        💰 Laporan Denda
    </a>

    <a href="laporan/buku_terlaris.php">
        🏆 Buku Terlaris
    </a>

    <a href="../logout.php">
        🚪 Logout
    </a>

</div>

<div class="content">

    <div class="header">

        <h1>Dashboard Administrator</h1>

        <p>
            Selamat Datang di Sistem Informasi Perpustakaan
        </p>

    </div>

    <div class="container">

        <div class="card">
            <h2><?= $anggota['total']; ?></h2>
            <p>Total Anggota</p>
        </div>

        <div class="card">
            <h2><?= $buku['total']; ?></h2>
            <p>Total Buku</p>
        </div>

        <div class="card">
            <h2><?= $peminjaman['total']; ?></h2>
            <p>Total Peminjaman</p>
        </div>

        <div class="card">
            <h2><?= $mahasiswa['total']; ?></h2>
            <p>Mahasiswa Terdaftar</p>
        </div>

        <div class="card">
            <h2><?= $terlaris['total']; ?></h2>
            <p>Buku Terlaris</p>
            <small>
                <?= $terlaris['judul_buku']; ?>
            </small>
        </div>

    </div>

    <div class="grafik">

        <h2 style="margin-bottom:20px;">
            Grafik Statistik Perpustakaan
        </h2>

        <canvas id="grafikPerpus"></canvas>

    </div>

    <div class="footer">
        Sistem Informasi Perpustakaan © <?= date('Y'); ?>
    </div>

</div>

<script>

const ctx =
document.getElementById('grafikPerpus');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [

            'Peminjaman',
            'Pengembalian',
            'Buku Terlaris'

        ],

        datasets: [{

            label:'Jumlah',

            data:[

                <?= $peminjaman['total']; ?>,
                <?= $pengembalian['total']; ?>,
                <?= $terlaris['total']; ?>

            ],

            backgroundColor:[

                '#3498db',
                '#2ecc71',
                '#f39c12'

            ]

        }]

    },

    options:{

        responsive:true,

        maintainAspectRatio:false,

        scales:{
            y:{
                beginAtZero:true
            }
        }

    }

});

</script>

</body>
</html>
```
