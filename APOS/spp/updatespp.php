<?php
session_start();
include("../koneksi.php");

$id = $_GET['id_spp'];
$idPetugas = $_SESSION['id_petugas'];
$nis = $_GET['nis'];
$bulan = $_GET['bulan'];
$jumlah = "";
$angkatan = $_GET['angkatan'];

if ($angkatan == "X")  {
  $jumlah = 600000;
}
else if ($angkatan == "XI")  {
  $jumlah = 650000;
}
else if ($angkatan == "XII")  {
  $jumlah = 700000;
}


$queryTransaksi = "INSERT INTO tb_transaksi VALUES ('', '$idPetugas', '$nis', '$bulan' , NOW(), '$jumlah')";
$resultTransaksi = mysqli_query($koneksi, $queryTransaksi);

if (!$resultTransaksi) {
die("Query gagal Dijalankan " . mysqli_error($koneksi));
}

$query = "UPDATE tb_spp SET jumlah_bayar = $jumlah WHERE id_spp = $id";
$result = mysqli_query($koneksi, $query);

if (!$result) {
die("Query gagal Dijalankan " . mysqli_error($koneksi));
}

// if (mysqli_affected_rows($koneksi) > 0) {
// echo "<script>
//             alert('Data Berhasil Diupdate');
//             document.location.href='../spp/spp.php?nis=$nis&angkatan=$angkatan'
//           </script>";
// } else {
// echo "<script>
//   alert('Data gagal Diupdate');
//   document.location.href = '../siswa/siswa.php';
// </script>";
// }

if (mysqli_affected_rows($koneksi) > 0) {
  // $url = "../spp/spp.php?nis=$nis&angkatan=$angkatan";
  // $url = str_replace("%20", " ", $url);
  echo "<script>
                alert('Data Berhasil Diupdate');
                document.location.href='../spp/spp.php?nis=$nis&angkatan=$angkatan';
              </script>";
} else {
  echo "<script>
                alert('Data gagal Diupdate');
                document.location.href = '../siswa/siswa.php';
            </script>";
}
