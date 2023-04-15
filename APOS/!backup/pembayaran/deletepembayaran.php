<?php

include('../koneksi.php');

$id_pembayaran = $_GET['id_pembayaran'];
$query = "DELETE FROM tb_pembayaran WHERE id_pembayaran='$id_pembayaran'";

$hasil = mysqli_query($koneksi, $query);

if (!$hasil) {
  die("Query gagal Dijalankan " . mysqli_error($koneksi));
} else {
  echo "<script>
  alert('Data Berhasil Delete');
  document.location.href='pembayaran.php';
  </script>";
}
