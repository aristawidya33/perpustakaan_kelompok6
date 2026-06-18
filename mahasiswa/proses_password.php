<?php
session_start();
include "../config/koneksi.php";

$id_user = $_SESSION['id_user'];

$password_lama = $_POST['password_lama'];
$password_baru = $_POST['password_baru'];
$konfirmasi = $_POST['konfirmasi'];

$data = mysqli_query($conn,"
SELECT * FROM users
WHERE id_user='$id_user'
");

$user = mysqli_fetch_assoc($data);

if($password_lama != $user['password']){

    echo "<script>
    alert('Password lama salah!');
    history.back();
    </script>";
    exit;
}

if($password_baru != $konfirmasi){

    echo "<script>
    alert('Konfirmasi password tidak cocok!');
    history.back();
    </script>";
    exit;
}

mysqli_query($conn,"
UPDATE users
SET password='$password_baru'
WHERE id_user='$id_user'
");

echo "<script>
alert('Password berhasil diubah!');
location='profil.php';
</script>";
?>