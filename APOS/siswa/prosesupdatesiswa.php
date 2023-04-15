<?php

include("../koneksi.php");

$nis = $_POST['nis'];
$id = $_POST["id_kelas"];
$nama = $_POST['nama'];
$password = $_POST["password"];
$alamat = $_POST["alamat"];
$tlp = $_POST["no_telp"];

$query = "UPDATE tb_siswa SET id_kelas='$id', nama = '$nama',password='$password', alamat = '$alamat', no_telp='$tlp' WHERE nis='$nis' ";

$hasil = mysqli_query($koneksi, $query);

if (!$hasil) {
  die("Query gagal Dijalankan " . mysqli_error($koneksi));
} else {
  echo "<script>
  alert('Data Berhasil Diupdate');
  document.location.href='siswa.php';
  </script>";
}
