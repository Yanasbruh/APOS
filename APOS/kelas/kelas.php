<?php
include "../koneksi.php";
session_start();
$per_halaman = 7;

// mencari total jumlah data pada tabel tb_kelas
$query_jumlah_data = "SELECT COUNT(*) AS jumlah_data FROM tb_kelas";
$hasil_jumlah_data = mysqli_query($koneksi, $query_jumlah_data);
$jumlah_data = mysqli_fetch_assoc($hasil_jumlah_data)['jumlah_data'];

// mencari jumlah halaman yang tersedia
$jumlah_halaman = ceil($jumlah_data / $per_halaman);

// mendapatkan halaman saat ini dari parameter GET
$halaman_saat_ini = isset($_GET['halaman']) ? $_GET['halaman'] : 1;

// mencari data yang akan ditampilkan pada halaman ini
$batas_data = ($halaman_saat_ini - 1) * $per_halaman;
$query_data = "SELECT * FROM tb_kelas LIMIT $batas_data, $per_halaman";
$result = mysqli_query($koneksi, $query_data);

if(isset($_POST['cari'])) {
  $id = $_POST['id_kelas'];
  $query = "SELECT * FROM tb_kelas WHERE id_kelas = '$id'";
  $result = mysqli_query($koneksi, $query);
}
?>


 <html>
  <head>
    <title>Data Kelas</title>
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
                <li><a href="../kelas/kelas.php" class="actives">Data Kelas</a></li>
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
      <input type="text" name="id_kelas" id="id_kelas" placeholder="Cari ID Kelas" required>
      <button type="submit" name="cari">Cari</button>
    </form>
<a href="tambahkelas.php" class="tambah">Tambah Kelas</a>


    <table>
      <thead>
        <tr>
        <th>ID Kelas</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th scope="col" colspan="2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($baris = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $baris['id_kelas']; ?></td>
            <td><?php echo $baris['kelas']; ?></td>
            <td><?php echo $baris['jurusan']; ?></td>
            <td><a href="updatekelas.php?id_kelas=<?php echo $baris['id_kelas']; ?>"><img src="../!backup/edit.svg" alt="ubah"class="rubah" ></a></td>
            <td><a href="deletekelas.php?id_kelas=<?php echo $baris['id_kelas']; ?>" onclick="return confirm('Andi yakin akan menghapus data ini?')"> <img src="../!backup/trash.svg" alt="hapus" class="hapus"></a></button></td>
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