<?php

session_start();

include "../config/koneksi.php";

$nik            = mysqli_real_escape_string($conn, trim($_POST['nik']));
$nama           = mysqli_real_escape_string($conn, trim($_POST['nama']));
$jenis_kelamin  = mysqli_real_escape_string($conn, trim($_POST['jenis_kelamin']));
$tempat_lahir   = mysqli_real_escape_string($conn, trim($_POST['tempat_lahir']));
$tanggal_lahir  = mysqli_real_escape_string($conn, trim($_POST['tanggal_lahir']));
$alamat         = mysqli_real_escape_string($conn, trim($_POST['alamat']));
$desa           = mysqli_real_escape_string($conn, trim($_POST['desa']));
$kecamatan      = mysqli_real_escape_string($conn, trim($_POST['kecamatan']));
$pekerjaan      = mysqli_real_escape_string($conn, trim($_POST['pekerjaan']));
$no_hp          = mysqli_real_escape_string($conn, trim($_POST['no_hp']));

if(
    empty($nik) ||
    empty($nama) ||
    empty($jenis_kelamin) ||
    empty($tempat_lahir) ||
    empty($tanggal_lahir) ||
    empty($alamat) ||
    empty($desa) ||
    empty($kecamatan) ||
    empty($pekerjaan)
){

echo "<script>

alert('Semua data wajib diisi!');

history.back();

</script>";

exit;

}

$cek = mysqli_query($conn,"
SELECT nik
FROM penduduk
WHERE nik='$nik'
");

if(mysqli_num_rows($cek)>0){

echo "<script>

alert('NIK sudah terdaftar!');

history.back();

</script>";

exit;

}

$simpan = mysqli_query($conn,"

INSERT INTO penduduk(

nik,
nama,
jenis_kelamin,
tempat_lahir,
tanggal_lahir,
alamat,
desa,
kecamatan,
pekerjaan,
no_hp

)

VALUES(

'$nik',
'$nama',
'$jenis_kelamin',
'$tempat_lahir',
'$tanggal_lahir',
'$alamat',
'$desa',
'$kecamatan',
'$pekerjaan',
'$no_hp'

)

");

if($simpan){

echo "<script>

alert('Data penduduk berhasil disimpan');

window.location='index.php';

</script>";

}else{

echo "<script>

alert('Data gagal disimpan');

history.back();

</script>";

}

?>