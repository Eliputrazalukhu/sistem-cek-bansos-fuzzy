<?php

session_start();

include "../config/koneksi.php";

$id=$_GET['id'];

mysqli_query($conn,"
DELETE FROM hasil_seleksi
WHERE id_hasil='$id'
");

header("Location:index.php");

?>