<?php
session_start();

include "config/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM users
    WHERE username='$username'"
);

$data = mysqli_fetch_assoc($query);

if($data){

    // Cek password biasa (plain text)
    if($password == $data['password']){

        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['role'] = $data['role'];
        $_SESSION['id_anggota'] = $data['id_anggota'];

        if($data['role'] == "admin"){

            header("Location: admin/dashboard.php");
            exit;

        }else{

            header("Location: mahasiswa/dashboard.php");
            exit;

        }

    }else{

        echo "
        <script>
            alert('Password salah!');
            window.location='login.php';
        </script>
        ";

    }

}else{

    echo "
    <script>
        alert('Username tidak ditemukan!');
        window.location='login.php';
    </script>
    ";

}
?>