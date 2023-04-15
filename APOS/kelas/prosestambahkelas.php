<?php
include("../koneksi.php");

$id = $_POST['id_kelas'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];

$query = "INSERT INTO tb_kelas VALUES (' $id', '$kelas', '$jurusan')";

$hasil = mysqli_query($koneksi, $query);

if (!$hasil) {
  die("Query gagal Dijalankan " . mysqli_error($koneksi));
} else {
  echo "<script>
  alert('Data Berhasil Ditambahkan');
  document.location.href='kelas.php';
  </script>";
}
