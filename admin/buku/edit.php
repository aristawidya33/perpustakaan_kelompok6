<?php

include "../../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query(
    $conn,
    "SELECT * FROM buku
    WHERE id_buku='$id'"
);

$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){

    mysqli_query($conn,"
    UPDATE buku SET

    kode_buku='$_POST[kode_buku]',
    judul_buku='$_POST[judul_buku]',
    pengarang='$_POST[pengarang]',
    penerbit='$_POST[penerbit]',
    tahun_terbit='$_POST[tahun_terbit]',
    stok='$_POST[stok]'

    WHERE id_buku='$id'
    ");

    header("Location:index.php");
}
?>

<h2>Edit Buku</h2>

<form method="POST">

Kode Buku <br>
<input type="text"
name="kode_buku"
value="<?= $d['kode_buku']; ?>">
<br><br>

Judul Buku <br>
<input type="text"
name="judul_buku"
value="<?= $d['judul_buku']; ?>">
<br><br>

Pengarang <br>
<input type="text"
name="pengarang"
value="<?= $d['pengarang']; ?>">
<br><br>

Penerbit <br>
<input type="text"
name="penerbit"
value="<?= $d['penerbit']; ?>">
<br><br>

Tahun Terbit <br>
<input type="number"
name="tahun_terbit"
value="<?= $d['tahun_terbit']; ?>">
<br><br>

Stok <br>
<input type="number"
name="stok"
value="<?= $d['stok']; ?>">
<br><br>

<button name="update">
Update
</button>

</form>