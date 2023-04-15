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
  <title>Laporan Kelas</title>
  <style>
    table,
    tr,
    th,
    td {
      border: 1px solid black;
      border-collapse: collapse;
    }
  </style>
</head>

<body>
  <h1>Laporan SPP</h1>
  <?php $idKelas =  $_POST['kelas']; ?>
  <?php $queryKelas = mysqli_query($koneksi, "SELECT * FROM tb_kelas WHERE id_kelas = '$idKelas'"); ?>
  <?php $dataKelas = mysqli_fetch_assoc($queryKelas); ?>
  <h3>Kelas: <?= $dataKelas['kelas']; ?></h3>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <?php $queryBulan = mysqli_query($koneksi, "SELECT bulan FROM tb_spp GROUP BY bulan ORDER BY id_spp"); ?>
        <?php while ($dataBulan = mysqli_fetch_assoc($queryBulan)) { ?>
          <th><?= $dataBulan['bulan']; ?></th>
        <?php } ?>
        <th>Jumlah Bayar</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      <?php $angkatan = $_POST['angkatan']; ?>

      <?php $querySiswaByKelas = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id_kelas = '$idKelas'"); ?>

      <?php $queryPembayaran = mysqli_query($koneksi, "SELECT * FROM tb_spp INNER JOIN tb_siswa USING(nis) INNER JOIN tb_kelas USING(id_kelas) WHERE id_kelas='$idKelas' AND angkatan='$angkatan' ORDER BY nama ASC"); ?>

      <?php $queryTerbayar = mysqli_query($koneksi, "SELECT nama, SUM(jumlah_bayar) FROM tb_spp INNER JOIN tb_siswa USING(nis) INNER JOIN tb_kelas USING(id_kelas) WHERE id_kelas = '$idKelas' AND angkatan = '$angkatan' AND jumlah_bayar IS NOT NULL GROUP BY nama ORDER BY nama ASC"); ?>

      <?php 
      $dataPembayaranArray = array();
      while ($dataPembayaran = mysqli_fetch_assoc($queryPembayaran)) {
          $dataPembayaranArray[] = $dataPembayaran;
      }

      $dataTerbayarArray = array();
      while ($dataTerbayar = mysqli_fetch_assoc($queryTerbayar)) {
          $dataTerbayarArray[] = $dataTerbayar;
      }
      ?>

<?php while ($dataSiswaByKelas = mysqli_fetch_assoc($querySiswaByKelas)) { ?>
    <tr>
        <td><?= $i++; ?></td>
        <td><?= $dataSiswaByKelas['nama']; ?></td>
        <?php foreach ($dataPembayaranArray as $dataPembayaran) { ?>
            <?php if ($dataPembayaran['nama'] == $dataSiswaByKelas['nama']) { ?>
                <td>Rp<?= number_format($dataPembayaran['jumlah_bayar'], 0, ',', '.'); ?></td>
            <?php } ?>
        <?php } ?>
        <?php foreach ($dataTerbayarArray as $dataTerbayar) { ?>
            <?php if ($dataTerbayar['nama'] == $dataSiswaByKelas['nama']) { ?>
                <td>Rp<?= number_format($dataTerbayar['SUM(jumlah_bayar)'], 0, ',', '.'); ?></td>
            <?php } ?>
        <?php } ?>
    </tr>
<?php } ?>

      <tr>
        <?php $queryTotalBayar = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) FROM tb_spp INNER JOIN tb_siswa USING(nis) INNER JOIN tb_kelas USING(id_kelas) WHERE id_kelas = '$idKelas' AND angkatan = '$angkatan' AND jumlah_bayar IS NOT NULL ORDER BY nama ASC"); ?>
        <?php $totalBayar = mysqli_fetch_assoc($queryTotalBayar); ?>
        <td colspan="14">Total</td>
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