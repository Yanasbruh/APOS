<?php
session_start();
session_unset();
session_destroy();

echo "<script>alert('Berhasil Logout');location.href='index.php';</script>";
