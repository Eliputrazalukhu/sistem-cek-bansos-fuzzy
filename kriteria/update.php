<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";

$id          = mysqli_real_escape_string($conn,$_POST['id']);
$kode        = mysqli_real_escape_string($conn,$_POST['kode_kriteria']);
$nama        = mysqli_real_escape_string($conn,$_POST['nama_kriteria']);
$bobot       = mysqli_real_escape_string($conn,$_POST['bobot']);
$tipe        = mysqli_real_escape_string($conn,$_POST['tipe']);
$keterangan  = mysqli_real_escape_string($conn,$_POST['keterangan']);

$cek=mysqli_query($conn,"
SELECT *
FROM kriteria
WHERE kode_kriteria='$kode'
AND id_kriteria!='$id'
");

if(mysqli_num_rows($cek)>0){

echo "<script>

alert('Kode kriteria sudah digunakan!');

history.back();

</script>";

exit;

}

$update=mysqli_query($conn,"

UPDATE kriteria SET

kode_kriteria='$kode',
nama_kriteria='$nama',
bobot='$bobot',
tipe='$tipe',
keterangan='$keterangan'

WHERE id_kriteria='$id'

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