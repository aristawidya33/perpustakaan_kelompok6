<?php

include "../../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query(
    $conn,
    "SELECT * FROM anggota
    WHERE id_anggota='$id'"
);

$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){

    mysqli_query($conn,"
    UPDATE anggota SET

    nim='$_POST[nim]',
    nama_anggota='$_POST[nama_anggota]',
    jurusan='$_POST[jurusan]',
    alamat='$_POST[alamat]',
    no_hp='$_POST[no_hp]'

    WHERE id_anggota='$id'
    ");

    header("Location:index.php");
}
?>

<h2>Edit Anggota</h2>

<form method="POST">

NIM <br>
<input type="text"
name="nim"
value="<?= $d['nim']; ?>">
<br><br>

Nama <br>
<input type="text"
name="nama_anggota"
value="<?= $d['nama_anggota']; ?>">
<br><br>

Jurusan <br>
<input type="text"
name="jurusan"
value="<?= $d['jurusan']; ?>">
<br><br>

Alamat <br>
<textarea name="alamat"><?= $d['alamat']; ?></textarea>
<br><br>

No HP <br>
<input type="text"
name="no_hp"
value="<?= $d['no_hp']; ?>">
<br><br>

<button name="update">
Update
</button>

</form>