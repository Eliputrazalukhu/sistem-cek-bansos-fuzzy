<?php

session_start();

if(!isset($_SESSION['login'])){
header("Location:../login/index.php");
exit;
}

include "../config/koneksi.php";

$id=$_POST['id'];

mysqli_query($conn,"

UPDATE rule_fuzzy SET

aset='$_POST[aset]',
rumah='$_POST[rumah]',
lantai='$_POST[lantai]',
dinding='$_POST[dinding]',
kepemilikan='$_POST[kepemilikan]',
pekerjaan='$_POST[pekerjaan]',
penghasilan='$_POST[penghasilan]',
tanggungan='$_POST[tanggungan]',
syarat_lain='$_POST[syarat_lain]',
hasil='$_POST[hasil]'

WHERE id_rule='$id'

");

echo "<script>

alert('Rule berhasil diupdate');

window.location='index.php';

</script>";

?>