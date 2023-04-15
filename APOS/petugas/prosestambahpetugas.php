<?php
include("../koneksi.php");

$id = $_POST["id_petugas"];
$usr = $_POST["username"];
$pass = $_POST["password"];
$lvl = $_POST['level']; 

$query = "INSERT INTO tb_petugas VALUES ('$id', '$usr', '$pass' ,'$lvl')";

$hasil = mysqli_query($koneksi, $query);

if (!$hasil) {
  die("Query gagal Dijalankan " . mysqli_error($koneksi));
} else {
  echo "<script>
  alert('Data Berhasil Ditambahkan');
  document.location.href='petugas.php';
  </script>";
}
