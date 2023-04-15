<?php
session_start();
include "../koneksi.php";

$query = "SELECT * FROM tb_transaksi INNER JOIN tb_siswa USING(nis) INNER JOIN tb_petugas USING(id_petugas) ORDER BY tgl_bayar DESC LIMIT 5";
$hasil = mysqli_query($koneksi, $query);

$queryS = "SELECT COUNT(*) as count_siswa FROM tb_siswa";
$hasilS = mysqli_query($koneksi, $queryS);
$dataS = mysqli_fetch_assoc($hasilS);
$count_siswa = $dataS['count_siswa'];

$queryP = "SELECT COUNT(*) as count_petugas FROM tb_petugas";
$hasilP = mysqli_query($koneksi, $queryP);
$dataP = mysqli_fetch_assoc($hasilP);
$count_petugas = $dataP['count_petugas'];

$queryK = "SELECT COUNT(*) as count_kelas FROM tb_kelas";
$hasilK = mysqli_query($koneksi, $queryK);
$dataK = mysqli_fetch_assoc($hasilK);
$count_kelas = $dataK['count_kelas'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashobard</title>
    <link rel="stylesheet" href="styledashboard.css">
</head>
<body>

<div class="container">
<nav>
    <ul>
    <li><a href="index.php" class="active">Dashboard</a></li>
    <li><a href="../petugas/petugas.php">Data Petugas</a></li>
    <li><a href="../siswa/siswa.php">Data Siswa</a></li>
    <li><a href="../kelas/kelas.php">Data Kelas</a></li>
    <li><a href="../spp/spp.php">Pembayaran</a></li>
    <li><a href="../history/history.php">History</a></li>
    <li><a href="../logout.php" class="keluar">Logout</a></li>
    </ul>
</nav>

<div class="container-1">
<h1 class="welcomeword">Hallo <div class="sapa"><?=$_SESSION['username']?></div> Selamat Datang di Dashboard !!!!!!</h1>
<main>
  <div class="table">
  <div class="kotak">
    <p>Jumaedi</p>
    <h3><?= $count_siswa ?></h3>
  <p>Data Siswa</p>
  </div>
  <div class="kotak">
  <p>Data Petugas</p>
  <h3><?= $count_petugas ?></h3>
  <p>Data Petugas</p>
  </div>
  <div class="kotak">
  <p>Data Kelas</p>
  <h3><?= $count_kelas ?></h3>
  <p>Data Petugas</p>
  </div>
  </div>
  <center>
    <h1>Data Riwayat Terakhir</h1>

    <table>
      <thead>
        <tr>
          <th>ID Riwayat</th>
          <th>Nama Petugas</th>
          <th>Nama siswa</th>
          <th>Bulan</th>
          <th>Tanggal Bayar</th>
          <th>Jumlah Bayar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($baris = mysqli_fetch_assoc($hasil)) {
        ?>
          <tr>
            <td><?php echo $baris['id_transaksi']; ?></td>
            <td><?php echo $baris['username']; ?></td>
            <td><?php echo $baris['nama']; ?></td>
            <td><?php echo $baris['bulan']; ?></td>
            <td><?php echo $baris['tgl_bayar']; ?></td>
            <td><?php echo $baris['bayar']; ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
</main>


</div></div>
</body>
</html>