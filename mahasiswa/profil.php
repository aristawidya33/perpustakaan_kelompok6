<?php
session_start();
include "../config/koneksi.php";

$id = $_SESSION['id_anggota'];

$data = mysqli_query($conn,"
SELECT * FROM anggota
WHERE id_anggota='$id'
");

$d = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil Mahasiswa</title>

    <style>
        body{
            font-family:'Segoe UI',sans-serif;
            background:linear-gradient(135deg,#eaf2ff,#ffffff);
            margin:0;
            padding:0;
        }

        .container{
            width:50%;
            margin:40px auto;
        }

        .card{
            background:white;
            border-radius:15px;
            box-shadow:0 5px 20px rgba(0,0,255,0.1);
            overflow:hidden;
        }

        .header{
            background:#1e5eff;
            color:white;
            text-align:center;
            padding:25px;
            font-size:22px;
            font-weight:bold;
        }

        .profile-body{
            padding:20px;
        }

        .avatar{
            width:80px;
            height:80px;
            background:#dbe9ff;
            color:#1e5eff;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:30px;
            font-weight:bold;
            margin:20px auto;
        }

        .row{
            display:flex;
            justify-content:space-between;
            padding:10px 0;
            border-bottom:1px solid #eee;
        }

        .label{
            font-weight:bold;
            color:#1e5eff;
        }

        .value{
            color:#333;
        }

        .password-box{
            margin-top:30px;
            padding-top:20px;
            border-top:2px solid #eee;
        }

        .password-box h3{
            color:#1e5eff;
            margin-bottom:15px;
        }

        input{
            width:100%;
            padding:10px;
            border:1px solid #ccc;
            border-radius:8px;
            margin-bottom:15px;
            box-sizing:border-box;
        }

        .btn-simpan{
            background:#1e5eff;
            color:white;
            border:none;
            padding:10px 15px;
            border-radius:8px;
            cursor:pointer;
        }

        .btn-simpan:hover{
            background:#003ecc;
        }

        .footer{
            text-align:center;
            padding:20px;
        }

        .btn{
            display:inline-block;
            background:#1e5eff;
            color:white;
            padding:10px 15px;
            text-decoration:none;
            border-radius:8px;
        }

        .btn:hover{
            background:#003ecc;
        }

    </style>

</head>
<body>

<div class="container">

    <div class="card">

        <div class="header">
            👤 Profil Mahasiswa
        </div>

        <div class="profile-body">

            <div class="avatar">
                <?= strtoupper(substr($d['nama_anggota'],0,1)); ?>
            </div>

            <div class="row">
                <div class="label">NIM</div>
                <div class="value"><?= $d['nim']; ?></div>
            </div>

            <div class="row">
                <div class="label">Nama</div>
                <div class="value"><?= $d['nama_anggota']; ?></div>
            </div>

            <div class="row">
                <div class="label">Jurusan</div>
                <div class="value"><?= $d['jurusan']; ?></div>
            </div>

            <div class="row">
                <div class="label">Alamat</div>
                <div class="value"><?= $d['alamat']; ?></div>
            </div>

            <div class="row">
                <div class="label">No HP</div>
                <div class="value"><?= $d['no_hp']; ?></div>
            </div>

            <!-- UBAH PASSWORD -->

            <div class="password-box">

                <h3>🔒 Ubah Password</h3>

                <form action="proses_password.php" method="POST">

                    <label>Password Lama</label>
                    <input type="password"
                           name="password_lama"
                           required>

                    <label>Password Baru</label>
                    <input type="password"
                           name="password_baru"
                           required>

                    <label>Konfirmasi Password Baru</label>
                    <input type="password"
                           name="konfirmasi"
                           required>

                    <button type="submit"
                            class="btn-simpan">
                        Simpan Password
                    </button>

                </form>

            </div>

        </div>

        <div class="footer">
            <a class="btn" href="dashboard.php">
                ← Kembali Dashboard
            </a>
        </div>

    </div>

</div>

</body>
</html>