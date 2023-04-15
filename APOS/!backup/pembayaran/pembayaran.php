<?php
include "../koneksi.php";
?>

    <?php
    $query = "SELECT * FROM tb_histori";
    $hasil = mysqli_query($koneksi, $query);
    ?>

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
            <?php if ($halaman == $halaman_saat_ini) : ?>
                <span class="active"><?php echo $halaman; ?></span>
            <?php else : ?>
                <a href="?halaman=<?php echo $halaman; ?>"><?php echo $halaman; ?></a>
            <?php endif; ?>
        <?php endfor; ?>
    </div>


 <html>
<body>
    <link rel="stylesheet" href="../style.css">
    <table>
        <tr>
        <th>ID Transaksi</th>
        <th>ID Petugas</th>
        <th>Nis</th>
        <th>Tanggal Bayar</th>
        <th>Bayar</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while ($baris = mysqli_fetch_assoc($hasil)) {
        ?>
          <tr>
            <td><?php echo $baris['id_transaksi']; ?></td>
            <td><?php echo $baris['id_petugas']; ?></td>
            <td><?php echo $baris['nis']; ?></td>
            <td><?php echo $baris['tgl_bayar']; ?></td>
            <td><?php echo $baris['bayar']; ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <a href="../index.php">Asyu</a>
</body>

</html>