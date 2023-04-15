<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Kelas</title>
  <link rel="stylesheet" href="../table.css">
</head>
<body>

<form action="prosestambahkelas.php" method="post">

<table border="2" cellpadding="10" cellspacing="0" class="input">
<tr>
          <tr class="upper">
          <td colspan="2">Form Tambah Kelas</td>
        </tr> 
  <tr>
    <td> ID Kelas</td>
    <td><input type="text" name="id_kelas" id="" maxlength="4" placeholder="1" required></td>
  </tr>
  <tr>
    <td>Kelas</td>
    <td><input type="text" name="kelas" id="" maxlength="8" placeholder="Contoh X-RPL1" required></td>
  </tr>
  <tr>
  <td>Jurusan</td>
  <td><input type="text" name="urusan" id="" maxlength="8" placeholder="Contoh RPL" required></td>
  </tr>
  <tr class="btn">
          <td colspan="2" >
            <button type="submit" class="submit">simpan</button>
          </td>
        </tr>

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