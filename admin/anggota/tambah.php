<?php
include "../../config/koneksi.php";

if(isset($_POST['simpan'])){

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
        '$_POST[nim]',
        '$_POST[nama_anggota]',
        '$_POST[jurusan]',
        '$_POST[alamat]',
        '$_POST[no_hp]'
    )
    ");

    header("Location:index.php");
}
?>

<h2>Tambah Anggota</h2>

<form method="POST">

NIM <br>
<input type="text" name="nim" required>
<br><br>

Nama <br>
<input type="text" name="nama_anggota" required>
<br><br>

Jurusan <br>
<input type="text" name="jurusan">
<br><br>

Alamat <br>
<textarea name="alamat"></textarea>
<br><br>

No HP <br>
<input type="text" name="no_hp">
<br><br>

<button name="simpan">
Simpan
</button>

</form>