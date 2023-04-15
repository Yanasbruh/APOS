<?php

include "../koneksi.php";
$id = $_GET['id_kelas'];

$query = "DELETE FROM tb_kelas WHERE id_kelas = $id";
$hasil = mysqli_query($koneksi,$query);

if (!$hasil) {
  die("Query gagal Dijalankan " . mysqli_error($koneksi));
} else {
  echo "<script>
  alert('Data Berhasil Delete');
  document.location.href='kelas.php';
  </script>";
}

?>