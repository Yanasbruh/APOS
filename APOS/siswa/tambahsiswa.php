<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Siswa</title>
  <link rel="stylesheet" href="../table.css">
</head>

<body>

    <form action="prosestambahsiswa.php" method="post">

      <table border="2" cellpadding="10" cellspacing="0">
      <tr>
          <tr class="upper">
          <td colspan="2">Form Tambah Siswa</td>
      </tr>
      <tr>
          <td>nis</td>
          <td><input type="text" name="nis" id="" maxlength="4" placeholder="Contoh : 1" required></td>
        </tr>
      <tr>
          <td>kelas</td>
          <td>
              <select name="kelas" id="" required>

              <?php
              include("../koneksi.php");

              $query = "SELECT * FROM tb_kelas";
              $hasil = mysqli_query($koneksi, $query);
              while ($row = mysqli_fetch_assoc($hasil)) {
              ?>
                <option value="<?php echo $row['id_kelas']; ?>"><?php echo $row['kelas']; ?></option>
              <?php
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>nama siswa</td>
          <td><input type="text" name="nama" id="" maxlength="50" placeholder="Contoh : Dewa Krsna" required></td>
        </tr>
        <tr>
          <td>password</td>
          <td><input type="text" name="password" id="" maxlength="20" placeholder="Contoh : password" required></td>
        </tr>
        <tr>
        <td>alamat</td>
        <td><input type="text" name="alamat" id="" maxlength="20" placeholder="Contoh : JL.Komodo" required></td>
        </tr>
        <tr>
          <td>Telpon</td>
          <td><input type="text" name="no_telp" id="" maxlength="12" placeholder="Contoh : 081771238124" required></td>
        </tr>
        <tr class="btn">
          <td colspan="2" > <button type="submit" class="submit">simpan</button></td>
        </tr>

      </table>

    </form>

    <style>
    table {
      height: 50vh;
      width:50vw;
    }
    td{
      font-size:1.3rem;
      text-align: center;
    }
    table .btn {
      height: 50px;
    }
    table .btn .submit {
    background-color: #f9f54b;
    color: #000;
    border: none;
    width: 200px;
    height: 35px;
    border-radius: 5px;
    }
    table .upper {
      height: 80px;
    }
    table input {
      height: 20px;
    }
    table select {
      width:170px;
      height:30px;
    }
  </style>

</body>

</html>