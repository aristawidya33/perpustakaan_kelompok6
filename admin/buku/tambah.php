<?php
include "../../config/koneksi.php";

if(isset($_POST['simpan'])){

    mysqli_query($conn,"
    INSERT INTO buku
    (
        kode_buku,
        judul_buku,
        pengarang,
        penerbit,
        tahun_terbit,
        stok
    )
    VALUES
    (
        '$_POST[kode_buku]',
        '$_POST[judul_buku]',
        '$_POST[pengarang]',
        '$_POST[penerbit]',
        '$_POST[tahun_terbit]',
        '$_POST[stok]'
    )
    ");

    header("Location:index.php");
}
?>

<h2>Tambah Buku</h2>

<form method="POST">

Kode Buku <br>
<input type="text" name="kode_buku" required>
<br><br>

Judul Buku <br>
<input type="text" name="judul_buku" required>
<br><br>

Pengarang <br>
<input type="text" name="pengarang">
<br><br>

Penerbit <br>
<input type="text" name="penerbit">
<br><br>

Tahun Terbit <br>
<input type="number" name="tahun_terbit">
<br><br>

Stok <br>
<input type="number" name="stok">
<br><br>

<button name="simpan">
Simpan
</button>

</form>