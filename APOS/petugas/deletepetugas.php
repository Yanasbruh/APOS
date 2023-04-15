<?php

include('../koneksi.php');

$id_petugas = $_GET['id_petugas'];
$query = "DELETE FROM tb_petugas WHERE id_petugas='$id_petugas'";

$hasil = mysqli_query($koneksi, $query);

if (!$hasil) {
  die("Query gagal Dijalankan " . mysqli_error($koneksi));
} else {
  echo "<script>
  alert('Data Berhasil Delete');
  document.location.href='petugas.php';
  </script>";
}
