<?php

include "../../config/koneksi.php";

$nim = $_POST['nim'];
$nama_anggota = $_POST['nama_anggota'];
$jurusan = $_POST['jurusan'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];

// Simpan ke tabel anggota
mysqli_query($conn,"
INSERT INTO anggota
(
    nim,
    nama_anggota,
    jurusan,
    alamat,
    no_hp
)
VALUES
(
    '$nim',
    '$nama_anggota',
    '$jurusan',
    '$alamat',
    '$no_hp'
)
");

// Ambil ID anggota yang baru dibuat
$id_anggota = mysqli_insert_id($conn);

// Password awal = NIM
$passwordHash = password_hash(
    $nim,
    PASSWORD_DEFAULT
);

// Buat akun mahasiswa otomatis
mysqli_query($conn,"
INSERT INTO users
(
    id_anggota,
    username,
    password,
    role
)
VALUES
(
    '$id_anggota',
    '$nim',
    '$passwordHash',
    'mahasiswa'
)
");

header("Location:index.php");
exit;

?>