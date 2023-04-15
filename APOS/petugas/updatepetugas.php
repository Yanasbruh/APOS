<?php
include("../koneksi.php");

$id_petugas = $_GET['id_petugas'];

$query = "SELECT * FROM tb_petugas WHERE id_petugas='$id_petugas '";
$hasil = mysqli_query($koneksi, $query);
while ($row = mysqli_fetch_assoc($hasil)) {

?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Update Data Petugas</title>
    <link rel="stylesheet" href="../table.css">
  </head>

  <body>
      <form action="prosesupdatepetugas.php" method="post">

        <table border="2" cellpadding="10" cellspacing="0">
          <tr>
            <input hidden type="text" name="id_petugas" value="<?php echo $row['id_petugas']; ?>">
          <tr>
          <tr class="upper">
          <td colspan="2">Form Update Petugas</td>
        </tr>
            <td>Username</td>
            <td><input type="text" name="username" value="<?php echo $row['username']; ?>"></td>
          </tr>
          <tr>
            <td>Password</td>
            <td><input type="text" name="password" value="<?php echo $row['password']; ?>"></td>
          </tr>
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
<?php
}
?>