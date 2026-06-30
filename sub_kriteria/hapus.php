<?php

session_start();

if(!isset($_SESSION['login'])){
header("Location:../login/index.php");
exit;
}

include "../config/koneksi.php";

$id=$_GET['id'];

mysqli_query($conn,"
DELETE FROM sub_kriteria
WHERE id_sub='$id'
");

echo "<script>

alert('Data berhasil dihapus');

window.location='index.php';

</script>";

?>