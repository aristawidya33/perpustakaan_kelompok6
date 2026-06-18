<?php
include "../../config/koneksi.php";

$cari = "";

if(isset($_GET['cari'])){

    $cari = mysqli_real_escape_string(
        $conn,
        $_GET['cari']
    );

    $data = mysqli_query($conn,"
    SELECT * FROM anggota
    WHERE
    nim LIKE '%$cari%'
    OR nama_anggota LIKE '%$cari%'
    OR jurusan LIKE '%$cari%'
    ORDER BY id_anggota DESC
    ");

}else{

    $data = mysqli_query(
        $conn,
        "SELECT * FROM anggota
        ORDER BY id_anggota DESC"
    );

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota</title>

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

        .toolbar{
            margin-top:15px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
            gap:10px;
        }

        .left-btn{
            display:flex;
            gap:10px;
        }

        .btn{
            text-decoration:none;
            padding:10px 14px;
            border-radius:8px;
            font-weight:bold;
            font-size:14px;
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

        .btn-add{
            background:#1e5eff;
            color:white;
        }

        .btn-add:hover{
            background:#003ecc;
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
            font-weight:bold;
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
            font-weight:bold;
        }

        .btn-reset:hover{
            background:#b02a37;
        }

        .hasil{
            margin-top:15px;
            color:#666;
            font-style:italic;
        }

        .card{
            margin-top:20px;
            background:white;
            padding:15px;
            border-radius:12px;
            box-shadow:0 5px 15px rgba(0,0,255,0.08);
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#e8f0ff;
            color:#1e5eff;
            padding:12px;
            border-bottom:2px solid #1e5eff;
            text-align:left;
        }

        td{
            padding:12px;
            border-bottom:1px solid #eee;
        }

        tr:hover{
            background:#f2f7ff;
        }

        .action a{
            text-decoration:none;
            padding:6px 10px;
            border-radius:6px;
            font-size:13px;
        }

        .edit{
            background:#1e5eff;
            color:white;
        }

        .hapus{
            background:#ff3b3b;
            color:white;
        }

        .edit:hover{
            background:#003ecc;
        }

        .hapus:hover{
            background:#cc0000;
        }

        .badge{
            background:#dbe9ff;
            color:#1e5eff;
            padding:4px 8px;
            border-radius:6px;
            font-size:12px;
        }

    </style>

</head>
<body>

<div class="container">

    <div class="header">
        👥 Data Anggota Perpustakaan
    </div>

    <div class="toolbar">

        <div class="left-btn">

            <a href="../dashboard.php"
            class="btn btn-back">
                ← Dashboard
            </a>

            <a href="tambah.php"
            class="btn btn-add">
                + Tambah Anggota
            </a>

        </div>

        <form method="GET"
        class="search-box">

            <input
            type="text"
            name="cari"
            placeholder="Cari NIM, Nama, Jurusan..."
            value="<?= $cari ?>">

            <button
            type="submit"
            class="btn-search">
                🔍 Cari
            </button>

            <a href="index.php"
            class="btn-reset">
                Reset
            </a>

        </form>

    </div>

    <?php if($cari != ""){ ?>

    <div class="hasil">
        Hasil pencarian untuk :
        <b><?= $cari ?></b>
    </div>

    <?php } ?>

    <div class="card">

        <table>

            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>

            <?php
            $no = 1;

            while($d = mysqli_fetch_array($data)){
            ?>

            <tr>

                <td><?= $no++ ?></td>

                <td>
                    <span class="badge">
                        <?= $d['nim'] ?>
                    </span>
                </td>

                <td><?= $d['nama_anggota'] ?></td>

                <td><?= $d['jurusan'] ?></td>

                <td><?= $d['alamat'] ?></td>

                <td><?= $d['no_hp'] ?></td>

                <td class="action">

                    <a
                    class="edit"
                    href="edit.php?id=<?= $d['id_anggota'] ?>">
                        Edit
                    </a>

                    <a
                    class="hapus"
                    href="hapus.php?id=<?= $d['id_anggota'] ?>"
                    onclick="return confirm('Yakin hapus data?')">
                        Hapus
                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>