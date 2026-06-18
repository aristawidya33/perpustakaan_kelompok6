<?php
session_start();
include "../../config/koneksi.php";

$id_buku = $_GET['id'];

$dataBuku = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT * FROM buku WHERE id_buku='$id_buku'"
)
);

if(isset($_POST['pinjam'])){

    $id_anggota = $_SESSION['id_anggota'];

    $tanggal_pinjam = $_POST['tanggal_pinjam'];

    mysqli_query($conn,"
    INSERT INTO peminjaman
    (
        id_anggota,
        id_buku,
        tanggal_pinjam,
        status
    )
    VALUES
    (
        '$id_anggota',
        '$id_buku',
        '$tanggal_pinjam',
        'dipinjam'
    )
    ");

    mysqli_query($conn,"
    UPDATE buku
    SET stok = stok - 1
    WHERE id_buku='$id_buku'
    ");

    header("Location: ../riwayat.php");
}
?>

<h2>Peminjaman Buku</h2>

<form method="POST">

Judul Buku<br>
<input type="text"
value="<?= $dataBuku['judul_buku']; ?>"
readonly>

<br><br>

Tanggal Pinjam<br>
<input type="date"
name="tanggal_pinjam"
required>

<br><br>

<button type="submit"
name="pinjam">
Pinjam Buku
</button>

</form>