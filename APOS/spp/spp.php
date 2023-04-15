<?php
session_start();
include "../koneksi.php";

$query = "SELECT * FROM tb_spp";
$hasil = mysqli_query($koneksi, $query);
if (!@$_SESSION) {
    echo "<script>alert('Anda Belum Login');location.href='../index.php';</script>";
} else if (@$_SESSION['nis']) {
    echo "<script>alert('Anda Siswa');location.href='../index.php';</script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <nav>
            <ul>
                <?php if (@$_SESSION['level'] === 'admin') : ?>
                    <li><a href="../dashboard/dashboard.php">Data Dashboard</a></li>
                    <li><a href="../petugas/petugas.php">Data Petugas</a></li>
                    <li><a href="../siswa/siswa.php">Data Siswa</a></li>
                    <li><a href="../kelas/kelas.php">Data Kelas</a></li>
                    <li><a href="../spp/spp.php" class="actives">Pembayaran</a></li>
                    <li><a href="../history/history.php">History</a></li>
                    <li><a href="../logout.php" class="keluar">Keluar</a></li>
                <?php elseif (@$_SESSION['level'] === 'petugas') : ?>
                    <li><a href="../spp/spp.php" class="actives">Pembayaran</a></li>
                    <li><a href="../history/history.php">History</a></li>
                    <li><a href="../logout.php" class="keluar">Keluar</a></li>
                <?php elseif (@$_SESSION['nis']) : ?>
                    <li><a href="../history/history.php">History</a></li>
                    <li><a href="../logout.php" class="keluar">Keluar</a></li>
                <?php endif; ?>
            </ul>
            </ul>
        </nav>


        <div class="container-1">

            <div class="warning">
                <h1>Silahkan Cari Nis Siswa dan Angkatan </h1>
            </div>
            <div class="search-spp">
                <form action="" method="GET">
                    <input type="text" name="nis" list="NISapa" placeholder="Cari Nis" required>
                    <datalist id="NISapa">
                        <?php
                        $query = "SELECT * FROM tb_siswa";
                        $result = mysqli_query($koneksi, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?= $row['nis'] ?>"></option>
                        <?php } ?>
                    </datalist>
                    <select name="angkatan" class="angkatan" required>
                        <option value="" selected>Pilih Angkatan</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                    <button type="submit" class="cari"> Cari </button></th>
                </form>
            </div>
            <br>
            <?php if (isset($_GET['nis'])) : ?>
                <table>
                    <?php
                    if (isset($_GET['nis'])) {
                        $nis = $_GET['nis'];
                        $angkatan = $_GET['angkatan'];
                        $querycari = "SELECT * FROM tb_spp INNER JOIN  tb_siswa USING(nis) WHERE nis = $nis AND angkatan = '$angkatan' ";
                        $resultcari = mysqli_query($koneksi, $querycari);

                        if ($angkatan == "X") {
                            $jumlah = 600000;
                        } else if ($angkatan == "XI") {
                            $jumlah = 650000;
                        } else if ($angkatan == "XII") {
                            $jumlah = 700000;
                        }
                    }
                    ?>
                    <tr>
                        <th>nis</th>
                        <th>nama</th>
                        <th>bulan</th>
                        <th>tahun ajaran</th>
                        <th>jumlah bayar</th>
                        <th>kelas</th>
                        <th>bayar lunas</th>
                    </tr>
                    <tr>
                        <?php while ($baris = mysqli_fetch_assoc($resultcari)) {
                        ?>
                            <td><?= $baris['nis']; ?></td>
                            <td><?= $baris['nama']; ?></td>
                            <td><?= $baris['bulan']; ?></td>
                            <td><?= $baris['tahun']; ?></td>
                            <td><?= $baris['jumlah_bayar']; ?></td>
                            <td><?= $baris['angkatan']; ?></td>
                            <?php if ($baris['jumlah_bayar'] == $jumlah) : ?>
                                <td>Lunas</td>
                            <?php else : ?>
                                <td><a class="bayar" href="updatespp.php?id_spp=<?= $baris['id_spp']; ?>&nis=<?= $baris['nis']; ?>&angkatan=<?= $baris['angkatan']; ?>&bulan=<?= $baris['bulan']; ?>">Bayar</a></td>
                            <?php endif; ?>
                    </tr>
                <?php } ?>
                </table>
            <?php endif; ?>

        </div>
    </div>
    </div>
</body>

</html>