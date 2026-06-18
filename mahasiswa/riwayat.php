<?php

session_start();
include "../config/koneksi.php";

if(!isset($_SESSION['id_anggota'])){
    header("Location: ../login.php");
    exit;
}

$id_anggota = $_SESSION['id_anggota'];

$data = mysqli_query($conn,"
SELECT
    p.*,
    b.judul_buku
FROM peminjaman p
JOIN buku b
ON p.id_buku = b.id_buku
WHERE p.id_anggota = '$id_anggota'
ORDER BY p.id_peminjaman DESC
");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Peminjaman</title>

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

        .topbar{
            margin-top: 15px;
        }

        .btn-back{
            display: inline-block;
            padding: 10px 15px;
            background: white;
            border: 2px solid #1e5eff;
            color: #1e5eff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
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
            text-align: center;
            border-bottom: 2px solid #1e5eff;
        }

        td{
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        tr:hover{
            background: #f2f7ff;
            transition: 0.3s;
        }

        .btn{
            display: inline-block;
            padding: 7px 10px;
            background: #1e5eff;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
        }

        .btn:hover{
            background: #003ecc;
        }

        .badge{
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }

        .dipinjam{
            background: #dbe9ff;
            color: #1e5eff;
        }

        .selesai{
            background: #d4f7e5;
            color: #1a7f4b;
        }

        .denda{
            color: #ff3b3b;
            font-weight: bold;
        }

        .empty{
            text-align: center;
            padding: 20px;
            color: #777;
        }

    </style>

</head>
<body>

<div class="container">

    <div class="header">
        📜 Riwayat Peminjaman Buku
    </div>

    <div class="topbar">
        <a class="btn-back" href="dashboard.php">← Kembali Dashboard</a>
    </div>

    <div class="card">

        <table>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Lama Pinjam</th>
                <th>Denda</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            <?php $no = 1; while($d = mysqli_fetch_assoc($data)){ ?>

            <tr>
                <td><?= $no++; ?></td>
                <td><?= $d['judul_buku']; ?></td>
                <td><?= $d['tanggal_pinjam']; ?></td>
                <td>
                    <?= $d['tanggal_kembali'] ? $d['tanggal_kembali'] : '-'; ?>
                </td>
                <td>
                    <?= $d['lama_pinjam'] ? $d['lama_pinjam'].' Hari' : '-'; ?>
                </td>
                <td class="denda">
                    Rp <?= number_format($d['denda']); ?>
                </td>

                <td>
                    <?php if($d['status'] == 'dipinjam'){ ?>
                        <span class="badge dipinjam">Dipinjam</span>
                    <?php } else { ?>
                        <span class="badge selesai">Selesai</span>
                    <?php } ?>
                </td>

                <td>
                    <?php if($d['status'] == 'dipinjam'){ ?>
                        <a class="btn" href="pengembalian/proses.php?id=<?= $d['id_peminjaman']; ?>">
                            Kembalikan
                        </a>
                    <?php } else { echo "-"; } ?>
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>