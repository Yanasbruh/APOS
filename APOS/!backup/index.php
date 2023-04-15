<?php
session_start();
include "../koneksi.php";

$query = "SELECT * FROM tb_transaksi INNER JOIN tb_siswa USING(nis) ORDER BY tgl_bayar DESC LIMIT 5";
$hasil = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashobard</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>


<nav>
    <ul>
    <li><a href="index.php">Dashboard</a></li>
    <li><a href="petugas/petugas.php">Data Petugas</a></li>
    <li><a href="siswa/siswa.php">Data Siswa</a></li>
    <li><a href="kelas/kelas.php">Data Kelas</a></li>
    <li><a href="spp/spp.php">Pembayaran</a></li>
    <li><a href="history/history.php">History</a></li>
    <div class="logout">
    <li><a href="logout.php">Logout</a></li>
    </div>
    </ul>
</nav>

<main>
  <div class="table">
  <div class="kotak">
    <p>Jumaedi</p>
    <!-- <h3><?= $data['siswa']['COUNT(*)']; ?></h3> -->
  <p>Data Siswa</p>
  </div>
  <div class="kotak">
  <p>Data Petugas</p>
  <!-- <h3><?= $data['petugas']['COUNT(*)']; ?></h3> -->
  </div>
  <div class="kotak">
  <p>Data Kelas</p>
  <!-- <h3><?= $data['Kelas']['COUNT(*)']; ?></h3> -->
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
            <td><?php echo $baris['id_petugas']; ?></td>
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
      </center>
  </center>
</main>


<style>
</style>
</body>
</html>