<?php
include "../koneksi.php";

session_start();
$namasiswa = $_POST['nama_siswa'];
$namapetugas = $_SESSION['ussername'];
$bulan = $_POST['bulan'];
$tgl = date("Y-m-d");
$nominal = $_POST['nominal'];

$querybayar = "INSERT INTO tb_pembayaran VALUES ('', '$namasiswa', '$namapetugas', '$bulan', '$tgl', '$nominal', '$nominal')";
mysqli_query($koneksi,$querybayar);
?>
<script  type="text/javascript">
    window.location = "../riwayat/riwayat.php";
 </script>