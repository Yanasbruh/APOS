<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Siswa</title>
</head>

<body>
  <center><br><br><br>


    <form action="prosestambahpembayaran.php" method="post">

      <table border="2" cellpadding="10" cellspacing="0">
      <tr>
          <td>nip</td>
          <td><input type="text" name="nip" id=""></td>
        </tr>
        <tr>
          <td>nama petugas</td>
          <td><input type="text" name="nama_petugas" id=""></td>
        </tr>
        <tr>
          <td>password</td>
          <td><input type="text" name="password" id=""></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td><input type="text" name="alamat" id=""></td>
        </tr>
        <tr>
          <td>Telpon</td>
          <td><input type="text" name="telpon" id=""></td>
        </tr>
        <tr>
        <tr>
          <td>Level User</td>
          <td>
        <select name="lvl_user" id="lvl_user">
        <option value="">admin</option>
        <option value="">petugas</option>
        </select>
        </td>
        </tr>
        <tr>
          <td></td>
          <td style="float: right;">
            <button type="submit">simpan</button>
          </td>
        </tr>

      </table>

    </form>

  </center>

</body>

</html>