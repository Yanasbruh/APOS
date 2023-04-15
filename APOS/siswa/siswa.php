<?php
  include "../koneksi.php";
  session_start();
if (!@$_SESSION) {
  echo "<script>alert('Anda Belum Login');location.href='../index.php';</script>";
 } else if (@$_SESSION['lvl_user'] == 'petugas') {
  echo "<script>alert('Anda Petugas');location.href='../index.php';</script>";
}else if (@$_SESSION['nis']) {
  echo "<script>alert('Anda Siswa');location.href='../index.php';</script>";
}

$per_halaman = 7;

// mencari total jumlah data pada tabel tb_kelas
$query_jumlah_data = "SELECT COUNT(*) AS jumlah_data FROM tb_siswa";
$hasil_jumlah_data = mysqli_query($koneksi, $query_jumlah_data);
$jumlah_data = mysqli_fetch_assoc($hasil_jumlah_data)['jumlah_data'];

// mencari jumlah halaman yang tersedia
$jumlah_halaman = ceil($jumlah_data / $per_halaman);

// mendapatkan halaman saat ini dari parameter GET
$halaman_saat_ini = isset($_GET['halaman']) ? $_GET['halaman'] : 1;

// mencari data yang akan ditampilkan pada halaman ini
$batas_data = ($halaman_saat_ini - 1) * $per_halaman;
$query_data = "SELECT * FROM tb_siswa INNER JOIN tb_kelas USING (id_kelas) LIMIT $batas_data, $per_halaman";
$result = mysqli_query($koneksi, $query_data);

if(isset($_POST['cari'])){
  $nis = $_POST['nis'];
  $query = "SELECT * FROM tb_siswa INNER JOIN tb_kelas USING (id_kelas) WHERE nis='$nis'";
  $result = mysqli_query($koneksi, $query);
}
?>




  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Siswa</title>
    <link rel="stylesheet" href="../style.css">  
  </head>
<body>
<div class="container">
<nav>
    <ul>
    <?php if (@$_SESSION['level'] === 'admin') : ?>
                <li><a href="../dashboard/dashboard.php">Data Dashboard</a></li>
                <li><a href="../petugas/petugas.php">Data Petugas</a></li>
                <li><a href="../siswa/siswa.php" class="actives">Data Siswa</a></li>
                <li><a href="../kelas/kelas.php">Data Kelas</a></li>
                <li><a href="../spp/spp.php">Pembayaran</a></li>
                <li><a href="../history/history.php">History</a></li>
                <li><a href="../logout.php" class="keluar">Keluar</a></li>
            <?php elseif (@$_SESSION['level'] === 'petugas') : ?>
                <li><a href="../spp/spp.php">Pembayaran</a></li>
                <li><a href="../history/history.php">History</a></li>
                <li><a href="../logout.php" class="keluar">Keluar</a></li>
            <?php elseif (@$_SESSION['nis']) : ?>
                <li><a href="../history/history.php">History</a></li>
                <li><a href="../logout.php" class="keluar">Keluar</a></li>
            <?php endif; ?></ul>
    </ul>
</nav>

<div class="container-1">
<form method="POST" action="">
    <input type="text" name="nis" id="nis" placeholder="Cari Nis Siswa" required>
    <button type="submit" name="cari">Cari</button>
</form>

<a href="tambahsiswa.php" class="tambah">Tambah Siswa</a>

<table>
  <thead>
    <tr>
      <th >Nis</th>
      <th > Kelas</th>
      <th >Nama Siswa</th>
      <th >Password</th>
      <th >Alamat</th>
      <th >No Telp</th>
      <th scope="col" colspan="3">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($data = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $data['nis']; ?></td>
        <td><?php echo $data['kelas']; ?></td>
        <td><?php echo $data['nama']; ?></td>
        <td><?php echo $data['password']; ?></td>
        <td><?php echo $data['alamat']; ?></td>
        <td><?php echo $data['no_telp']; ?></td>
        <td>
          <a href="updatesiswa.php?nis=<?php echo $data['nis']; ?>">
            <img src="../!backup/edit.svg" alt="ubah" class="rubah">
          </a>
        </td>
        <td>
          <a href="deletesiswa.php?nis=<?php echo $data['nis']; ?>" onclick="return confirm('Andi yakin akan menghapus data ini?')">
            <img src="../!backup/trash.svg" alt="hapus" class="hapus">
          </a>
        </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<div class="pagination">
        <?php for ($halaman = 1; $halaman <= $jumlah_halaman; $halaman++) : ?>
            <?php if ($halaman == $halaman_saat_ini) : ?>
                <span class="active"><?php echo $halaman; ?></span>
            <?php else : ?>
                <a href="?halaman=<?php echo $halaman; ?>"><?php echo $halaman; ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
</div>
</div>
</body>

</html>