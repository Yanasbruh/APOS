<?php
include("../koneksi.php");

$id = $_GET['nis'];

$query = "SELECT * FROM tb_siswa WHERE nis='$id'";
$hasil = mysqli_query($koneksi, $query);
while ($row = mysqli_fetch_assoc($hasil)) {

?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Update Data Siswa</title>
    <link rel="stylesheet" href="../table.css">
  </head>

  <body>


      <form action="prosesupdatesiswa.php" method="post">

        <table border="2" cellpadding="10" cellspacing="0">
          <tr>
            <input hidden type="text" name="nis" value="<?php echo $row['nis']; ?>">
          </tr>
          <tr class="upper">
           <td colspan="2">Form Update Siswa</td>
         </tr>
          <tr>
               <td>Kelas</td>
            <td>
              <select name="id_kelas" id="" required>
                  <option selected value="">Pilih Kelas</option>

                <option value="">---------------------------------------</option>

                <?php
                $querykelas = "SELECT id_kelas,kelas FROM tb_kelas";
                $hasilangkatan = mysqli_query($koneksi, $querykelas);
                while ($rowangkatan = mysqli_fetch_assoc($hasilangkatan)) {
                ?>
                  <option value="<?php echo $rowangkatan['id_kelas']; ?>"><?php echo $rowangkatan['kelas']; ?></option>
                <?php
                }
                ?>
              </select> 
              </td>         
          </tr>
          <tr>
              <td>Nama Siswa</td>
              <td><input type="text" name="nama" value="<?php echo $row['nama']; ?>"></td>
           </tr>
           <tr>
            <td>Password</td>
            <td><input type="text" name="password" value="<?php echo $row['password']; ?>"></td>
           </tr>
            <tr>
              <td>Alamat</td>
              <td><input type="text" name="alamat" value="<?php echo $row['alamat']; ?>" maxlength="50" placeholder="Contoh : JL.Komodo" required></td>
           </tr> 
           <tr>
            <td>Telpon</td>
            <td><input type="text" name="no_telp" value="<?php echo $row['no_telp']; ?>"maxlength="12" placeholder="Contoh : 08123001293" required></td>
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
<?php
}
?>