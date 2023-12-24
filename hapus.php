<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}
require 'function.php';
$id_peserta = $_GET['id_peserta'];
if (hapus($id_peserta) > 0) {
    echo "<script>
                alert('Data peserta berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
} else {
    echo "<script>
            alert('Data peserta gagal dihapus!');
        </script>";
}
