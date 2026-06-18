<?php
include "../../config/koneksi.php";

$data = mysqli_query($conn,"SELECT * FROM buku");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>

    <style>
        body{
            font-family: 'Segoe UI', sans-serif;
            background: #f3f7ff;
            margin: 0;
            padding: 0;
        }

        .container{
            width: 95%;
            margin: 40px auto;
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
            font-size: 14px;
        }

        .btn-add{
            background: #1e5eff;
            color: white;
        }

        .btn-add:hover{
            background: #003ecc;
            transition: 0.3s;
        }

        .btn-back{
            background: white;
            color: #1e5eff;
            border: 2px solid #1e5eff;
        }

        .btn-back:hover{
            background: #1e5eff;
            color: white;
            transition: 0.3s;
        }

        .card{
            margin-top: 20px;
            background: white;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,255,0.08);
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        th{
            background: #e8f0ff;
            color: #1e5eff;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #1e5eff;
        }

        td{
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        tr:hover{
            background: #f2f7ff;
        }

        .badge{
            display: inline-block;
            padding: 5px 10px;
            border-radius: 6px;
            background: #dbe9ff;
            color: #1e5eff;
            font-size: 12px;
        }

        .stok{
            font-weight: bold;
            color: #1e5eff;
        }

        .stok-habis{
            color: #ff3b3b;
            font-weight: bold;
        }

        .action a{
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 13px;
        }

        .edit{
            background: #1e5eff;
            color: white;
        }

        .hapus{
            background: #ff3b3b;
            color: white;
        }

        .edit:hover{
            background: #003ecc;
        }

        .hapus:hover{
            background: #cc0000;
        }

    </style>

</head>
<body>

<div class="container">

    <div class="header">
        📚 Data Buku Perpustakaan
    </div>

    <div class="toolbar">

        <a href="../dashboard.php" class="btn btn-back">
            ← Dashboard
        </a>

        <a href="tambah.php" class="btn btn-add">
            + Tambah Buku
        </a>

    </div>

    <div class="card">

        <table>

            <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>

            <?php $no=1; while($d=mysqli_fetch_array($data)){ ?>

            <tr>
                <td><?= $no++ ?></td>
                <td><span class="badge"><?= $d['kode_buku'] ?></span></td>
                <td><?= $d['judul_buku'] ?></td>
                <td><?= $d['pengarang'] ?></td>
                <td><?= $d['penerbit'] ?></td>
                <td><?= $d['tahun_terbit'] ?></td>

                <td>
                    <?php if($d['stok'] > 0){ ?>
                        <span class="stok"><?= $d['stok'] ?></span>
                    <?php } else { ?>
                        <span class="stok-habis">Habis</span>
                    <?php } ?>
                </td>

                <td class="action">
                    <a class="edit" href="edit.php?id=<?= $d['id_buku'] ?>">Edit</a>
                    <a class="hapus" href="hapus.php?id=<?= $d['id_buku'] ?>" onclick="return confirm('Hapus data?')">Hapus</a>
                </td>
            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>