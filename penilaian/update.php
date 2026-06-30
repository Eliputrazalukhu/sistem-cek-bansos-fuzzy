<?php

session_start();

if(!isset($_SESSION['login'])){
header("Location:../login/index.php");
exit;
}

include "../config/koneksi.php";

$id=$_POST['id'];
$id_penduduk=$_POST['id_penduduk'];
$id_kriteria=$_POST['id_kriteria'];
$id_sub=$_POST['id_sub'];
$nilai=$_POST['nilai'];
$tanggal=$_POST['tanggal_penilaian'];

mysqli_query($conn,"

UPDATE penilaian SET

id_penduduk='$id_penduduk',
id_kriteria='$id_kriteria',
id_sub='$id_sub',
nilai='$nilai',
tanggal_penilaian='$tanggal'

WHERE id_penilaian='$id'

");

echo "<script>

alert('Data berhasil diupdate');

window.location='index.php';

</script>";

?>