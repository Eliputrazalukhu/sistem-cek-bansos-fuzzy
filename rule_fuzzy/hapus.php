<?php

session_start();

if(!isset($_SESSION['login'])){
header("Location:../login/index.php");
exit;
}

include "../config/koneksi.php";

$id=$_GET['id'];

mysqli_query($conn,"
DELETE FROM rule_fuzzy
WHERE id_rule='$id'
");

echo "<script>

alert('Rule berhasil dihapus');

window.location='index.php';

</script>";

?>