<?php

include("../koneksi.php");

$id_petugas = $_POST['id_petugas'];
$usr = $_POST["username"];
$password = $_POST["password"];
$lvl = $_POST["level"];

$query = "UPDATE tb_petugas SET username='$usr', password='$password', level='$lvl' WHERE id_petugas='$id_petugas' ";

$hasil = mysqli_query($koneksi, $query);

if (!$hasil) {
  die("Query gagal Dijalankan " . mysqli_error($koneksi));
} else {
  echo "<script>
  alert('Data Berhasil Diupdate');
  document.location.href='petugas.php';
  </script>";
}
