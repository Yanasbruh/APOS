<?php
include("../koneksi.php");

$id_kelas = $_GET['id_kelas'];

$query = "SELECT * FROM tb_kelas WHERE id_kelas='$id_kelas '";
$hasil = mysqli_query($koneksi, $query);
while ($row = mysqli_fetch_assoc($hasil)) {

?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Update Data Kelas</title>
    <link rel="stylesheet" href="../table.css">
  </head>

  <body>


      <form action="prosesupdatekelas.php" method="post">

        <table border="2" cellpadding="10" cellspacing="0">
          <tr>
            <input hidden type="text" name="id_kelas" value="<?php echo $row['id_kelas']; ?>">
          <tr>
          <tr>
          <tr class="upper">
          <td colspan="2">Form Update Kelas</td>
        </tr>
            <td>Kelas</td>
            <td><input type="text" name="kelas" value="<?php echo $row['kelas']; ?>"></td>
          </tr>
          <tr>
            <td>Jurusan</td>
            <td><input type="text" name="jurusan" value="<?php echo $row['jurusan']; ?>"></td>
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
  </style>

  </body>

  </html>
<?php
}
?>