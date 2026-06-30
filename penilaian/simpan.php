<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";

$id_penduduk = mysqli_real_escape_string($conn,$_POST['id_penduduk']);
$id_kriteria = mysqli_real_escape_string($conn,$_POST['id_kriteria']);
$id_sub = mysqli_real_escape_string($conn,$_POST['id_sub']);
$nilai = mysqli_real_escape_string($conn,$_POST['nilai']);
$tanggal = mysqli_real_escape_string($conn,$_POST['tanggal_penilaian']);

$cek = mysqli_query($conn,"
SELECT *
FROM penilaian
WHERE id_penduduk='$id_penduduk'
AND id_kriteria='$id_kriteria'
");

if(mysqli_num_rows($cek)>0){

echo "<script>

alert('Penduduk sudah memiliki penilaian pada kriteria ini!');

history.back();

</script>";

exit;

}

$simpan=mysqli_query($conn,"

INSERT INTO penilaian(

id_penduduk,
id_kriteria,
id_sub,
nilai,
tanggal_penilaian

)

VALUES(

'$id_penduduk',
'$id_kriteria',
'$id_sub',
'$nilai',
'$tanggal'

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