<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";

$id = $_GET['id'];

$hapus = mysqli_query($conn,"
DELETE FROM penduduk
WHERE id_penduduk='$id'
");

if($hapus){

echo "<script>

alert('Data berhasil dihapus');

window.location='index.php';

</script>";

}else{

echo "<script>

alert('Data gagal dihapus');

window.location='index.php';

</script>";

}

?>