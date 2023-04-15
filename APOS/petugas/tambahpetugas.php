<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Petugas</title>
  <link rel="stylesheet" href="../table.css">
</head>

<body>
    <form action="prosestambahpetugas.php" method="post">

      <table border="2" cellpadding="10" cellspacing="0">
        <tr class="upper">
          <td colspan="2">Form Tambah Petugas</td>
        </tr>
      <tr>
          <td>ID Petugas</td>
          <td><input type="text" name="id_petugas" id="" maxlength="4" placeholder="Contoh : 1" required></td>
        </tr>
        <tr>
          <td>Username Petugas</td>
          <td><input type="text" name="username" id="" maxlength="15" placeholder="Contoh : Ayu" required></td>
        </tr>
        <tr>
          <td>password</td>
          <td><input type="text" name="password" id="" maxlength="15" placeholder="Contoh : password" required></td>
        <tr>
          <td>Level User</td>
          <td>
        <select name="level" id="level">
        <option value="admin">admin</option>
        <option value="petugas">petugas</option>
        </select>
        </td>
        </tr>
        <tr class="btn">
          <td colspan="2" >
            <button type="submit" class="submit">simpan</button>
          </td>
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