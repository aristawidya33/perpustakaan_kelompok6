<?php
session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['id_anggota'])){
    header("Location: ../login.php");
    exit;
}

$id_anggota = $_SESSION['id_anggota'];

$mhs = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT *
FROM anggota
WHERE id_anggota='$id_anggota'
")
);

$pinjam = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM peminjaman
WHERE id_anggota='$id_anggota'
")
);

$kembali = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM peminjaman
WHERE id_anggota='$id_anggota'
AND status='dikembalikan'
")
);

$denda = mysqli_fetch_assoc(
mysqli_query($conn,"
SELECT SUM(denda) AS total
FROM peminjaman
WHERE id_anggota='$id_anggota'
")
);

if($denda['total'] == NULL){
    $denda['total'] = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard Mahasiswa</title>

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

/* SIDEBAR */

.sidebar{
    position:fixed;
    left:0;
    top:0;
    width:250px;
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
    transition:0.3s;
}

.sidebar a:hover{
    background:rgba(255,255,255,.2);
}

/* CONTENT */

.content{
    margin-left:250px;
    padding:20px;
}

.header{
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 2px 10px rgba(0,0,0,.1);
}

.header h1{
    color:#333;
}

.profil{
    margin-top:20px;
    background:white;
    padding:20px;
    border-radius:15px;
    box-shadow:0 2px 10px rgba(0,0,0,.1);
}

.profil p{
    margin-top:10px;
}

/* CARD */

.card-container{
    margin-top:25px;

    display:grid;

    grid-template-columns:
    repeat(
        auto-fit,
        minmax(220px,1fr)
    );

    gap:20px;
}

.card{
    background:white;
    border-radius:15px;
    padding:25px;
    text-align:center;
    box-shadow:0 3px 15px rgba(0,0,0,.1);
}

.card h2{
    font-size:35px;
    color:#007bff;
}

.card p{
    margin-top:10px;
    color:#666;
}

.footer{
    text-align:center;
    margin-top:30px;
    color:#777;
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

<!-- SIDEBAR -->

<div class="sidebar">

    <h2>🎓 MAHASISWA</h2>

    <a href="dashboard.php">
        🏠 Dashboard
    </a>

    <a href="buku.php">
        📚 Data Buku
    </a>

    <a href="peminjaman/index.php">
        📖 Peminjaman
    </a>

    <a href="pengembalian/index.php">
        🔄 Pengembalian
    </a>

    <a href="riwayat.php">
        📋 Riwayat
    </a>

    <a href="profil.php">
        👤 Profil Saya
    </a>

    <a href="../logout.php">
        🚪 Logout
    </a>

</div>

<!-- CONTENT -->

<div class="content">

    <div class="header">

        <h1>Dashboard Mahasiswa</h1>

        <p>
            Selamat datang di Sistem Informasi Perpustakaan
        </p>

    </div>

    <div class="profil">

        <h2>
            Halo,
            <?= $mhs['nama_anggota']; ?>
        </h2>

        <p>
            <b>NIM :</b>
            <?= $mhs['nim']; ?>
        </p>

        <p>
            <b>Jurusan :</b>
            <?= $mhs['jurusan']; ?>
        </p>

    </div>

    <div class="card-container">

        <div class="card">
            <h2>
                <?= $pinjam['total']; ?>
            </h2>

            <p>Total Peminjaman</p>
        </div>

        <div class="card">

            <h2>
                <?= $kembali['total']; ?>
            </h2>

            <p>Buku Dikembalikan</p>

        </div>

        <div class="card">

            <h2>
                Rp <?= number_format($denda['total']); ?>
            </h2>

            <p>Total Denda</p>

        </div>

    </div>

    <div class="footer">

        Sistem Informasi Perpustakaan © <?= date('Y'); ?>

    </div>

</div>

</body>
</html>