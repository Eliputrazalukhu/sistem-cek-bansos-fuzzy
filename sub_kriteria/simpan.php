<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";

$id_kriteria = mysqli_real_escape_string($conn,$_POST['id_kriteria']);
$nama_sub = mysqli_real_escape_string($conn,$_POST['nama_sub']);
$nilai = mysqli_real_escape_string($conn,$_POST['nilai']);
$kategori = mysqli_real_escape_string($conn,$_POST['kategori_fuzzy']);

$cek=mysqli_query($conn,"
SELECT *
FROM sub_kriteria
WHERE id_kriteria='$id_kriteria'
AND nama_sub='$nama_sub'
");

if(mysqli_num_rows($cek)>0){

echo "<script>

alert('Sub Kriteria sudah ada');

history.back();

</script>";

exit;

}

$simpan=mysqli_query($conn,"

INSERT INTO sub_kriteria(

id_kriteria,
nama_sub,
nilai,
kategori_fuzzy

)

VALUES(

'$id_kriteria',
'$nama_sub',
'$nilai',
'$kategori'

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