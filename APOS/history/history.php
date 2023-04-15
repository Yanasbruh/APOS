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
  <title>Riwayat</title>
  <link rel="stylesheet" href="../style.css">
</head>

<body>
  <div class="container">
  <nav>
    <ul>
    <?php if (@$_SESSION['level'] === 'admin') : ?>
                <li><a href="../dashboard/dashboard.php">Dashboard</a></li>
                <li><a href="../petugas/petugas.php">Data Petugas</a></li>
                <li><a href="../siswa/siswa.php">Data Siswa</a></li>
                <li><a href="../kelas/kelas.php">Data Kelas</a></li>
                <li><a href="../spp/spp.php">Pembayaran</a></li>
                <li><a href="../history/history.php" class="actives">History</a></li>
                <li><a href="../logout.php" class="keluar">Keluar</a></li>
            <?php elseif (@$_SESSION['level'] === 'petugas') : ?>
                <li><a href="../spp/spp.php">Pembayaran</a></li>
                <li><a href="../history/history.php" class="actives">History</a></li>
                <li><a href="../logout.php" class="keluar">Keluar</a></li>
            <?php elseif (@$_SESSION['nis']) : ?>
                <li><a href="../history/history.php" class="actives">History</a></li>
                <li><a href="../logout.php" class="keluar">Keluar</a></li>
            <?php endif; ?>
          </ul>
  </nav>

  <div class="container-1">
  <?php if (@$_SESSION['level'] === 'admin') : ?>
  <div class="print">
    <div class="kelas">
      <form action="laporan_kelas.php" method="POST" autocomplete="off">
        <select name="kelas" id="kelas" required>
          <option value="" selected>Pilih Kelas</option>
          <?php $queryKelas = mysqli_query($koneksi, "SELECT * FROM tb_kelas"); ?>
          <?php while ($dataKelas = mysqli_fetch_assoc($queryKelas)) { ?>
            <option value="<?= $dataKelas['id_kelas']; ?>"><?= $dataKelas['kelas']; ?></option>
            <?php } ?>
          </select>
          <select name="angkatan" id="angkatan" class="drop" required>
            <option value="" selected>Pilih Angkatan</option>
        <option value="X">X</option>
        <option value="XI">XI</option>
        <option value="XII">XII</option>
      </select>
      <button type="submit" class="buat">Buat Laporan Kelas</button>
    </form>
  </div>
  
  <div class="siswa">
    <form action="laporan_siswa.php" method="POST" autocomplete="off">
      <input type="text" name="nis" id="nis" placeholder="Masukkan NIS Siswa" required>
      <select name="angkatan" id="angkatan" class="drop" required>
        <option value="" selected>Pilih Angkatan</option>
        <option value="X">X</option>
        <option value="XI">XI</option>
        <option value="XII">XII</option>
      </select>
      <button type="submit" class="buat">Buat Laporan Siswa</button>
    </form>
  </div>
</div>
  <?php endif; ?>


  <?php if (@$_SESSION['level'] === 'petugas') : ?>
  <div class="print">
    <div class="kelas">
      <form action="laporan_kelas.php" method="POST" autocomplete="off">
        <select name="kelas" id="kelas" required>
          <option value="" selected>Pilih Kelas</option>
          <?php $queryKelas = mysqli_query($koneksi, "SELECT * FROM tb_kelas"); ?>
          <?php while ($dataKelas = mysqli_fetch_assoc($queryKelas)) { ?>
            <option value="<?= $dataKelas['id_kelas']; ?>"><?= $dataKelas['kelas']; ?></option>
            <?php } ?>
          </select>
          <select name="angkatan" id="angkatan" class="drop" required>
            <option value="" selected>Pilih Angkatan</option>
        <option value="X">X</option>
        <option value="XI">XI</option>
        <option value="XII">XII</option>
      </select>
      <button type="submit" class="buat">Buat Laporan Kelas</button>
    </form>
  </div>
  
  <div class="siswa">
    <form action="laporan_siswa.php" method="POST" autocomplete="off">
      <input type="text" name="nis" id="nis" placeholder="Masukkan NIS Siswa" required>
      <select name="angkatan" id="angkatan" class="drop" required>
        <option value="" selected>Pilih Angkatan</option>
        <option value="X">X</option>
        <option value="XI">XI</option>
        <option value="XII">XII</option>
      </select>
      <button type="submit" class="buat">Buat Laporan Siswa</button>
    </form>
  </div>
</div>

<?php endif; ?>


<table>
      <thead>
        <tr>
          <th>No</th>
          <th>Petugas</th>
          <th>Nama siswa</th>
          <th>Bulan</th>
          <th>Tanggal Bayar</th>
          <th>Jumlah Bayar</th>
        </tr>
      </thead>
      <tbody>
      <?php
  $rows_per_page = 5;
  $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $offset = ($current_page - 1) * $rows_per_page;

  if(@$_SESSION['nis']) {
    $nis = $_SESSION['nis'];
    $queryTransaksi = mysqli_query($koneksi, "SELECT * FROM tb_transaksi INNER JOIN tb_siswa USING(nis) INNER JOIN tb_petugas USING(id_petugas)  ORDER BY tgl_bayar DESC LIMIT " . ($current_page - 1) * $rows_per_page . ", $rows_per_page");
  } else {
    $queryTransaksi = mysqli_query($koneksi, "SELECT * FROM tb_transaksi INNER JOIN tb_siswa USING(nis) INNER JOIN tb_petugas USING(id_petugas)  ORDER BY tgl_bayar DESC LIMIT " . ($current_page - 1) * $rows_per_page . ", $rows_per_page");

  }

  $i = $offset + 1;
  while ($dataTransaksi = mysqli_fetch_assoc($queryTransaksi)) {
?>
    <tr>
      <td><?php echo $i++; ?></td>
      <td><?php echo $dataTransaksi['username']; ?></td>
      <td><?php echo $dataTransaksi['nama']; ?></td>
      <td><?php echo $dataTransaksi['bulan']; ?></td>
      <td><?php echo $dataTransaksi['tgl_bayar']; ?></td>
      <td><?php echo $dataTransaksi['bayar']; ?></td>
    </tr>
<?php
  }
?>
</tbody>
</table>

<!-- Add pagination links below the table -->
<?php 
$per_halaman = 7;

// mencari total jumlah data pada tabel tb_kelas
$query_jumlah_data = "SELECT COUNT(*) AS jumlah_data FROM tb_transaksi";
$hasil_jumlah_data = mysqli_query($koneksi, $query_jumlah_data);
$jumlah_data = mysqli_fetch_assoc($hasil_jumlah_data)['jumlah_data'];

// mencari jumlah halaman yang tersedia
$jumlah_halaman = ceil($jumlah_data / $per_halaman);

// mendapatkan halaman saat ini dari parameter GET
$halaman_saat_ini = isset($_GET['halaman']) ? $_GET['halaman'] : 1;

// mencari data yang akan ditampilkan pada halaman ini
$batas_data = ($halaman_saat_ini - 1) * $per_halaman;
$query_data = "SELECT * FROM tb_transaksi LIMIT $batas_data, $per_halaman";
$result = mysqli_query($koneksi, $query_data);
?>
<div class="pagination">
    <?php for ($halaman = 1; $halaman <= $jumlah_halaman; $halaman++) : ?>
        <?php if ($halaman == $current_page) : ?>
            <span class="active"><?php echo $halaman; ?></span>
        <?php else : ?>
            <a href="?page=<?php echo $halaman; ?>"><?php echo $halaman; ?></a>
        <?php endif; ?>
    <?php endfor; ?>
</div>


    </div>
    </div>
</body>

</html>