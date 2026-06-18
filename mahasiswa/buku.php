<?php
session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['role'])){
    header("Location: ../login.php");
    exit;
}

$cari = "";

if(isset($_GET['cari'])){
    $cari = mysqli_real_escape_string(
        $conn,
        $_GET['cari']
    );

    $data = mysqli_query($conn,"
    SELECT * FROM buku
    WHERE
    kode_buku LIKE '%$cari%'
    OR judul_buku LIKE '%$cari%'
    OR pengarang LIKE '%$cari%'
    OR penerbit LIKE '%$cari%'
    ");
}else{

    $data = mysqli_query(
        $conn,
        "SELECT * FROM buku"
    );

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Buku</title>

    <style>

        body{
            font-family:'Segoe UI',sans-serif;
            background:#f3f7ff;
            margin:0;
            padding:0;
        }

        .container{
            width:90%;
            margin:40px auto;
        }

        .header{
            background:#1e5eff;
            color:white;
            padding:20px;
            border-radius:12px;
            text-align:center;
            font-size:22px;
            font-weight:bold;
        }

        .topbar{
            margin-top:15px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
            gap:10px;
        }

        .btn-back{
            background:white;
            color:#1e5eff;
            padding:10px 15px;
            border-radius:8px;
            text-decoration:none;
            border:2px solid #1e5eff;
            font-weight:bold;
        }

        .btn-back:hover{
            background:#1e5eff;
            color:white;
            transition:0.3s;
        }

        .search-box{
            display:flex;
            gap:10px;
        }

        .search-box input{
            padding:10px;
            width:250px;
            border:1px solid #ccc;
            border-radius:8px;
        }

        .btn-search{
            background:#1e5eff;
            color:white;
            border:none;
            padding:10px 15px;
            border-radius:8px;
            cursor:pointer;
        }

        .btn-search:hover{
            background:#003ecc;
        }

        .btn-reset{
            background:#dc3545;
            color:white;
            text-decoration:none;
            padding:10px 15px;
            border-radius:8px;
        }

        .card{
            margin-top:20px;
            background:white;
            padding:15px;
            border-radius:12px;
            box-shadow:0 4px 15px rgba(0,0,255,0.08);
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#e8f0ff;
            color:#1e5eff;
            padding:12px;
            text-align:left;
            border-bottom:2px solid #1e5eff;
        }

        td{
            padding:12px;
            border-bottom:1px solid #eee;
        }

        tr:hover{
            background:#f2f7ff;
        }

        .btn-pinjam{
            display:inline-block;
            padding:8px 12px;
            background:#1e5eff;
            color:white;
            text-decoration:none;
            border-radius:6px;
            font-size:14px;
        }

        .btn-pinjam:hover{
            background:#003ecc;
        }

        .stok-habis{
            color:red;
            font-weight:bold;
        }

        .badge{
            padding:5px 10px;
            border-radius:6px;
            font-size:12px;
            background:#dbe9ff;
            color:#1e5eff;
            display:inline-block;
        }

        .hasil{
            margin-top:10px;
            color:#666;
            font-style:italic;
        }

    </style>

</head>
<body>

<div class="container">

    <div class="header">
        📚 Daftar Buku Perpustakaan
    </div>

    <div class="topbar">

        <a class="btn-back" href="dashboard.php">
            ← Kembali Dashboard
        </a>

        <form method="GET" class="search-box">

            <input
                type="text"
                name="cari"
                placeholder="Cari buku..."
                value="<?= $cari ?>"
            >

            <button
                type="submit"
                class="btn-search">
                🔍 Cari
            </button>

            <a
                href="buku.php"
                class="btn-reset">
                Reset
            </a>

        </form>

    </div>

    <?php if($cari!=""){ ?>

    <div class="hasil">
        Hasil pencarian untuk :
        <b><?= $cari ?></b>
    </div>

    <?php } ?>

    <div class="card">

        <table>

            <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul Buku</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no=1;

            while($d=mysqli_fetch_array($data)){
            ?>

            <tr>

                <td><?= $no++ ?></td>

                <td>
                    <span class="badge">
                        <?= $d['kode_buku'] ?>
                    </span>
                </td>

                <td><?= $d['judul_buku'] ?></td>

                <td><?= $d['pengarang'] ?></td>

                <td><?= $d['penerbit'] ?></td>

                <td><?= $d['stok'] ?></td>

                <td>

                <?php if($d['stok'] > 0){ ?>

                    <a
                    class="btn-pinjam"
                    href="peminjaman/tambah.php?id=<?= $d['id_buku']; ?>">
                        Pinjam
                    </a>

                <?php } else { ?>

                    <span class="stok-habis">
                        Stok Habis
                    </span>

                <?php } ?>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>