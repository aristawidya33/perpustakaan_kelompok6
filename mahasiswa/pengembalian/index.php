<?php
session_start();
include "../../config/koneksi.php";

$id_anggota = $_SESSION['id_anggota'];

$data = mysqli_query($conn, "
SELECT p.*, b.judul_buku
FROM peminjaman p
JOIN buku b ON p.id_buku=b.id_buku
WHERE p.id_anggota='$id_anggota'
AND p.status='dipinjam'
");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Pengembalian Buku</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #eaf2ff, #ffffff);
            margin: 0;
            padding: 0;
        }

        .wrapper {
            width: 85%;
            margin: 40px auto;
        }

        .header {
            background: #1e5eff;
            color: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }

        /* 🔵 NAV BUTTON */
        .nav {
            margin-top: 15px;
            display: flex;
            justify-content: flex-start;
        }

        .btn-back {
            display: inline-block;
            padding: 10px 15px;
            background: white;
            color: #1e5eff;
            border: 2px solid #1e5eff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-back:hover {
            background: #1e5eff;
            color: white;
            transition: 0.3s;
        }

        .card {
            background: white;
            margin-top: 20px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 255, 0.08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #e6f0ff;
            color: #1e5eff;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #1e5eff;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #f2f7ff;
            transition: 0.3s;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            background: #1e5eff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn:hover {
            background: #003ecc;
        }
    </style>

</head>

<body>

    <div class="wrapper">

        <div class="header">
            📚 Pengembalian Buku
        </div>

        <!-- 🔵 TOMBOL KEMBALI (INI YANG HILANG) -->
        <div class="nav">
            <a class="btn-back" href="../dashboard.php">
                ← Kembali ke Dashboard
            </a>
        </div>

        <div class="card">

            <table>
                <tr>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Aksi</th>
                </tr>

                <?php while ($d = mysqli_fetch_array($data)) { ?>
                    <tr>
                        <td><?= $d['judul_buku']; ?></td>
                        <td><?= $d['tanggal_pinjam']; ?></td>
                        <td><?= $d['tanggal_kembali']; ?></td>
                        <td>
                            <a class="btn" href="proses.php?id=<?= $d['id_peminjaman']; ?>">
                                Kembalikan
                            </a>
                        </td>
                    </tr>
                <?php } ?>

            </table>

        </div>

    </div>

</body>

</html>