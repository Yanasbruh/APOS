<?php
session_start();

include "../koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$queryadmin = mysqli_query($koneksi, "SELECT * FROM tb_petugas WHERE username = '$username' AND password = '$password' AND level = 'admin'") or die(mysqli_error($koneksi));
$querypetugas = mysqli_query($koneksi, "SELECT * FROM tb_petugas WHERE username = '$username' AND password = '$password' AND level = 'petugas'") or die(mysqli_error($koneksi));
$querysiswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE nis = '$username' AND password = '$password'") or die(mysqli_error($koneksi));



    if (mysqli_num_rows($queryadmin) > 0) {
        $data = mysqli_fetch_assoc($queryadmin);
        $_SESSION['id_petugas'] = $data['id_petugas'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['level'] = $data['level'];
        echo "<script>alert('Anda login sebagai admin');window.location.href='../petugas/petugas.php'</script>";
    } 
    
    else if (mysqli_num_rows($querypetugas) > 0) {
        $data = mysqli_fetch_assoc($querypetugas);
        $_SESSION['id_petugas'] = $data['id_petugas'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['level'] = $data['level'];
        echo "<script>alert('Anda login sebagai Petugas');window.location.href='../spp/spp.php'</script>";
    }
    
    else if (mysqli_num_rows($querysiswa) > 0) {
        $data = mysqli_fetch_assoc($querysiswa);
        $_SESSION['nis'] = $data['nis'];
        echo "<script>alert('Anda login sebagai siswa');window.location.href='../history/history.php'</script>";
    }

    else {
    echo "<script>alert('Username atau Password salah');window.location.href='../index.php'</script>";
    }
