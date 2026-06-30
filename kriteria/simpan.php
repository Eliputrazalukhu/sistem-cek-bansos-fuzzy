<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";

$kode       = mysqli_real_escape_string($conn,$_POST['kode_kriteria']);
$nama       = mysqli_real_escape_string($conn,$_POST['nama_kriteria']);
$bobot      = mysqli_real_escape_string($conn,$_POST['bobot']);
$tipe       = mysqli_real_escape_string($conn,$_POST['tipe']);
$keterangan = mysqli_real_escape_string($conn,$_POST['keterangan']);

$cek = mysqli_query($conn,"
SELECT *
FROM kriteria
WHERE kode_kriteria='$kode'
");

if(mysqli_num_rows($cek)>0){

echo "<script>

alert('Kode kriteria sudah ada!');

history.back();

</script>";

exit;

}

$simpan=mysqli_query($conn,"

INSERT INTO kriteria(

kode_kriteria,
nama_kriteria,
bobot,
tipe,
keterangan

)

VALUES(

'$kode',
'$nama',
'$bobot',
'$tipe',
'$keterangan'

)

");

if($simpan){

echo "<script>

alert('Data berhasil disimpan');

window.location='index.php';

</script>";

}else{

echo "<script>

alert('Data gagal disimpan');

history.back();

</script>";

}

?>