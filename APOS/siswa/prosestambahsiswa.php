<?php
include("../koneksi.php");

$id = $_POST["nis"];
$idk = $_POST["kelas"];
$nama = $_POST["nama"];
$pass = $_POST["password"];
$alamat = $_POST["alamat"];
$telp = $_POST["no_telp"];

$query = "INSERT INTO tb_siswa VALUES ('$id', '$idk', '$nama', '$pass',  '$alamat', '$telp')";

mysqli_query($koneksi, $query);

function querySPP($id, $tahun, $angkatan) {
  global $koneksi;

  $querySPP = "INSERT INTO tb_spp VALUES 
                            ('', '$id', 'Juli', '$tahun', '', '$angkatan'),
                            ('', '$id', 'Agustus', '$tahun', '', '$angkatan'),
                            ('', '$id', 'September', '$tahun', '', '$angkatan'),
                            ('', '$id', 'Oktober', '$tahun', '', '$angkatan'),
                            ('', '$id', 'November', '$tahun', '', '$angkatan'),
                            ('', '$id', 'Desember', '$tahun', '', '$angkatan'),
                            ('', '$id', 'Januari', '$tahun', '', '$angkatan'),
                            ('', '$id', 'Februari', '$tahun', '', '$angkatan'),
                            ('', '$id', 'Maret', '$tahun', '', '$angkatan'),
                            ('', '$id', 'April', '$tahun', '', '$angkatan'),
                            ('', '$id', 'Mei', '$tahun', '', '$angkatan'),
                            ('', '$id', 'Juni', '$tahun', '', '$angkatan')";

    mysqli_query($koneksi, $querySPP);
}


$thnSekarang = date('Y');
$thnDepan = date('Y') + 1;
$duaThnDepan = date('Y') + 2;
$tigaThnDepan = date('Y') + 3;

$thnAjaranSekarang = "$thnSekarang/$thnDepan";
$thnAjaranDepan = "$thnDepan/$duaThnDepan";
$thnAjaranLusa = "$duaThnDepan/$tigaThnDepan";

querySPP($id, $thnAjaranSekarang, 'X');
querySPP($id, $thnAjaranDepan, 'XI');
querySPP($id, $thnAjaranLusa, 'XII');

if (!mysqli_affected_rows($koneksi) > 0) {
  die("Query gagal Dijalankan " . mysqli_error($koneksi));
} else {
  echo "<script>
              alert('Data Berhasil Ditambahkan');
              document.location.href='siswa.php';
              </script>";
}
