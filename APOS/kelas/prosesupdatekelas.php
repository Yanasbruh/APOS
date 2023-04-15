<?php 

include("../koneksi.php");

$id = $_POST['id_kelas'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];

$hasil = mysqli_query($koneksi, $query = "UPDATE tb_kelas SET kelas = '$kelas', jurusan = '$jurusan' WHERE id_kelas = $id");

if (!$hasil) {
    die("Query gagal Dijalankan " . mysqli_error($koneksi));
  } else {
    echo "<script>
    alert('Data Berhasil Diupdate');
    document.location.href='kelas.php';
    </script>";
  }

?>