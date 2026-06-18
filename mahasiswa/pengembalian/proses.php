<?php

include "../../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT * FROM peminjaman
WHERE id_peminjaman='$id'"
)
);

if(isset($_POST['kembalikan'])){

    $tanggal_kembali =
    $_POST['tanggal_kembali'];

    $lama_pinjam =
    (
        strtotime($tanggal_kembali)
        -
        strtotime($data['tanggal_pinjam'])
    )
    /
    (60*60*24);

    $denda = 0;

    /*
    Maksimal 3 hari
    */

    if($lama_pinjam > 3){

        $terlambat =
        $lama_pinjam - 3;

        $denda =
        $terlambat * 2000;

    }

    mysqli_query($conn,"
    UPDATE peminjaman
    SET
    tanggal_kembali='$tanggal_kembali',
    lama_pinjam='$lama_pinjam',
    denda='$denda',
    status='dikembalikan'
    WHERE id_peminjaman='$id'
    ");

    mysqli_query($conn,"
    UPDATE buku
    SET stok = stok + 1
    WHERE id_buku='".$data['id_buku']."'
    ");

    header("Location: ../riwayat.php");
}
?>

<h2>Pengembalian Buku</h2>

<form method="POST">

Tanggal Kembali<br>

<input type="date"
name="tanggal_kembali"
required>

<br><br>

<button
type="submit"
name="kembalikan">
Simpan Pengembalian
</button>

</form>