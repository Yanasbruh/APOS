<?php

include('../koneksi.php');

$nis = $_GET['nis'];
$query = "DELETE FROM tb_siswa WHERE nis='$nis'";

$hasil = mysqli_query($koneksi, $query);

if (!$hasil) {
  die("Query gagal Dijalankan " . mysqli_error($koneksi));
} else {
  echo "<script>
  alert('Data Berhasil Delete');
  document.location.href='siswa.php';
  </script>";
}
