<?php

session_start();

if(!isset($_SESSION['login'])){
header("Location:../login/index.php");
exit;
}

include "../config/koneksi.php";

$id=mysqli_real_escape_string($conn,$_POST['id']);
$id_kriteria=mysqli_real_escape_string($conn,$_POST['id_kriteria']);
$nama_sub=mysqli_real_escape_string($conn,$_POST['nama_sub']);
$nilai=mysqli_real_escape_string($conn,$_POST['nilai']);
$kategori=mysqli_real_escape_string($conn,$_POST['kategori_fuzzy']);

$update=mysqli_query($conn,"

UPDATE sub_kriteria SET

id_kriteria='$id_kriteria',
nama_sub='$nama_sub',
nilai='$nilai',
kategori_fuzzy='$kategori'

WHERE id_sub='$id'

");

if($update){

echo "<script>

alert('Data berhasil diupdate');

window.location='index.php';

</script>";

}else{

echo "<script>

alert('Data gagal diupdate');

history.back();

</script>";

}

?>