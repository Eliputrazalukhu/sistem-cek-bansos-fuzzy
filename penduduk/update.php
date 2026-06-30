<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";

$id              = mysqli_real_escape_string($conn,$_POST['id']);
$nik             = mysqli_real_escape_string($conn,$_POST['nik']);
$nama            = mysqli_real_escape_string($conn,$_POST['nama']);
$jenis_kelamin   = mysqli_real_escape_string($conn,$_POST['jenis_kelamin']);
$tempat_lahir    = mysqli_real_escape_string($conn,$_POST['tempat_lahir']);
$tanggal_lahir   = mysqli_real_escape_string($conn,$_POST['tanggal_lahir']);
$alamat          = mysqli_real_escape_string($conn,$_POST['alamat']);
$desa            = mysqli_real_escape_string($conn,$_POST['desa']);
$kecamatan       = mysqli_real_escape_string($conn,$_POST['kecamatan']);
$pekerjaan       = mysqli_real_escape_string($conn,$_POST['pekerjaan']);
$no_hp           = mysqli_real_escape_string($conn,$_POST['no_hp']);

$cek = mysqli_query($conn,"
SELECT *
FROM penduduk
WHERE nik='$nik'
AND id_penduduk!='$id'
");

if(mysqli_num_rows($cek)>0){

echo "<script>

alert('NIK sudah digunakan!');

history.back();

</script>";

exit;

}

$update = mysqli_query($conn,"

UPDATE penduduk SET

nik='$nik',
nama='$nama',
jenis_kelamin='$jenis_kelamin',
tempat_lahir='$tempat_lahir',
tanggal_lahir='$tanggal_lahir',
alamat='$alamat',
desa='$desa',
kecamatan='$kecamatan',
pekerjaan='$pekerjaan',
no_hp='$no_hp'

WHERE id_penduduk='$id'

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