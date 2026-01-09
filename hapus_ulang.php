<?php
include 'koneksi.php';

$no = $_GET['no'];
mysqli_query($conn,"DELETE FROM ulang WHERE no_daftar='$no'");

header("Location: daftar_ulang.php");
?>
