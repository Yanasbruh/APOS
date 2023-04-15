<?php 
session_start();
include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Siswa</title>
    
</head>

<body>
<style>
    table,
    tr,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }
  </style>
    <h1>Laporan SPP Siswa</h1>
    <?php $nis =  $_POST['nis']; ?>
    <?php $querySiswa = mysqli_query($koneksi ,"SELECT * FROM tb_siswa INNER JOIN tb_kelas USING(id_kelas) WHERE nis = $nis"); ?>
    <?php $dataSiswa = mysqli_fetch_assoc($querySiswa) ?>
    <h3>Nama: <?= $dataSiswa['nama']; ?></h3>
    <h3>Kelas: <?= $dataSiswa['kelas']; ?></h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Bulan</th>
                <th>Jumlah Bayar</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php $angkatan = $_POST['angkatan']; ?>
            <?php $queryPembayaran = mysqli_query($koneksi, "SELECT * FROM tb_spp WHERE nis = $nis AND angkatan = '$angkatan'"); ?>
            <?php while ($dataPembayaran = mysqli_fetch_assoc($queryPembayaran)) { ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $dataPembayaran['bulan']; ?></td>
                    <td><?= $dataPembayaran['jumlah_bayar']; ?></td>
                </tr>
            <?php } ?>
            <tr>
                <?php $queryTotalBayar = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) FROM tb_spp WHERE nis = $nis AND angkatan = '$angkatan' AND jumlah_bayar IS NOT NULL"); ?>
                <?php $totalBayar = mysqli_fetch_assoc($queryTotalBayar); ?>
                <th colspan="2">Total</th>
                <td>Rp<?= number_format($totalBayar['SUM(jumlah_bayar)'], 0, ',', '.'); ?></td>
            </tr>
        </tbody>
    </table>
    <p>Jika tertera Rp.0 Maka artinya siswa belum membayar SPP di bulan tersebut</p>

    <p>Denpasar, <?= date('d-m-Y'); ?></p>
    <p>Dewa Krsna</p>

    <script>
        window.print();
        window.onafterprint = () =>history.back;
    </script>
</body>


</html>