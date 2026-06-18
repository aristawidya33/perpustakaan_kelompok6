<?php
session_start();
include "../../config/koneksi.php";

$id_anggota = $_SESSION['id_anggota'];

$data = mysqli_query($conn,"
SELECT p.*, b.judul_buku
FROM peminjaman p
JOIN buku b ON p.id_buku = b.id_buku
WHERE p.id_anggota='$id_anggota'
AND p.status='dipinjam'
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buku Dipinjam</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background: #f4f8ff;
            margin: 0;
            padding: 0;
        }

        .container{
            width: 80%;
            margin: 50px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,255,0.1);
        }

        h2{
            text-align: center;
            color: #1e5eff;
            margin-bottom: 20px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 10px;
        }

        th{
            background: #1e5eff;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td{
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even){
            background: #f0f6ff;
        }

        tr:hover{
            background: #dbe9ff;
            transition: 0.3s;
        }

        .btn-kembali{
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #1e5eff;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        .btn-kembali:hover{
            background: #003ecc;
        }
    </style>

</head>
<body>

<div class="container">

    <h2>Buku Yang Sedang Dipinjam</h2>

    <table>
        <tr>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Status</th>
        </tr>

        <?php while($d=mysqli_fetch_array($data)){ ?>
        <tr>
            <td><?= $d['judul_buku']; ?></td>
            <td><?= $d['tanggal_pinjam']; ?></td>
            <td><?= $d['status']; ?></td>
        </tr>
        <?php } ?>

    </table>

    <a class="btn-kembali" href="../dashboard.php">← Kembali</a>

</div>

</body>
</html>