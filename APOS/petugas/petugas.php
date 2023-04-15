<?php
include "../koneksi.php";
session_start();

if (!@$_SESSION) {
  echo "<script>alert('Anda Belum Login');location.href='../index.php';</script>";
 } else if (@$_SESSION['level'] == 'petugas') {
  echo "<script>alert('Anda Petugas');location.href='../index.php';</script>";
}else if (@$_SESSION['nis']) {
  echo "<script>alert('Anda Siswa');location.href='../index.php';</script>";
}

$per_halaman = 5;

// mencari total jumlah data pada tabel tb_petugas
$query_jumlah_data = "SELECT COUNT(*) AS jumlah_data FROM tb_petugas";
$hasil_jumlah_data = mysqli_query($koneksi, $query_jumlah_data);
$jumlah_data = mysqli_fetch_assoc($hasil_jumlah_data)['jumlah_data'];

// mencari jumlah halaman yang tersedia
$jumlah_halaman = ceil($jumlah_data / $per_halaman);

// mendapatkan halaman saat ini dari parameter GET
$halaman_saat_ini = isset($_GET['halaman']) ? $_GET['halaman'] : 1;

// mencari data yang akan ditampilkan pada halaman ini
$batas_data = ($halaman_saat_ini - 1) * $per_halaman;
$query_data = "SELECT * FROM tb_petugas LIMIT $batas_data, $per_halaman";
$result = mysqli_query($koneksi, $query_data);

if(isset($_POST['cari'])){
  $id = $_POST['id_petugas'];
  $query = "SELECT * FROM tb_petugas WHERE id_petugas='$id'";
  $result = mysqli_query($koneksi, $query);
}

?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabel Petugas</title>
  <link rel="stylesheet" href="../style.css">
 </head>
<body>
  <div class="container">
  <nav>
    <ul>
    <?php if (@$_SESSION['level'] === 'admin') : ?>
                <li><a href="../dashboard/dashboard.php">Data Dashboard</a></li>
                <li><a href="../petugas/petugas.php" class="actives">Data Petugas</a></li>
                <li><a href="../siswa/siswa.php">Data Siswa</a></li>
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
    <input type="text" name="id_petugas" id="id_petugas" placeholder="Cari ID Petugas" required>
    <button type="submit" name="cari">Cari</button>
  </form>
    <a href="tambahpetugas.php" class="tambah">Tambah Petugas</a>

    <table>
      <thead>
        <tr>
          <th >ID Petugas</th>
          <th >Username</th>
          <th >Password</th>
          <th >Level Petugas</th>
          <th scope="col" colspan="2">Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php
    while ($baris = mysqli_fetch_assoc($result)) {
      $login = $_SESSION['id_petugas'];
        ?>
        <tr>
            <td><?php echo $baris['id_petugas']; ?></td>
            <td><?php echo $baris['username']; ?></td>
            <td><?php echo $baris['password']; ?></td>
            <td><?php echo $baris['level']; ?></td>
            <td><a href="updatepetugas.php?id_petugas=<?php echo $baris['id_petugas']; ?>"><img src="../!backup/edit.svg" alt="ubah"class="rubah" ></a></td>
            <td>
                <?php if ($baris['id_petugas'] !== $login) {  ?>
                    <a href="deletepetugas.php?id_petugas=<?php echo $baris['id_petugas']; ?>" onclick="return confirm('Andi yakin akan menghapus data ini?')">
                        <img src="../!backup/trash.svg" alt="hapus" class="hapus">
                    </a>
                <?php } else { ?>
                        <img src="../!backup/trash.svg" alt="hapus" class="hapus disabled">
                <?php } ?>
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
    <style>
      .disabled {
        opacity:0.5;
      }
    </style>
  </body>

</html>