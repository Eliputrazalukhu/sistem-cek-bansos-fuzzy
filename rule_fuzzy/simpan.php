<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";

$aset=$_POST['aset'];
$rumah=$_POST['rumah'];
$lantai=$_POST['lantai'];
$dinding=$_POST['dinding'];
$kepemilikan=$_POST['kepemilikan'];
$pekerjaan=$_POST['pekerjaan'];
$penghasilan=$_POST['penghasilan'];
$tanggungan=$_POST['tanggungan'];
$syarat_lain=$_POST['syarat_lain'];
$hasil=$_POST['hasil'];

mysqli_query($conn,"

INSERT INTO rule_fuzzy(

aset,
rumah,
lantai,
dinding,
kepemilikan,
pekerjaan,
penghasilan,
tanggungan,
syarat_lain,
hasil

)

VALUES(

'$aset',
'$rumah',
'$lantai',
'$dinding',
'$kepemilikan',
'$pekerjaan',
'$penghasilan',
'$tanggungan',
'$syarat_lain',
'$hasil'

)

");

echo "<script>

alert('Rule berhasil disimpan');

window.location='index.php';

</script>";

?>