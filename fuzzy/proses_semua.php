<?php

session_start();

if(!isset($_SESSION['login'])){

header("Location:../login/index.php");
exit;

}

include "../config/koneksi.php";
include "fungsi_fuzzy.php";


/*
====================================
HAPUS DETAIL PROSES LAMA
====================================
*/

mysqli_query($conn,"
DELETE FROM detail_fuzzy
");



/*
====================================
AMBIL SEMUA PENDUDUK
====================================
*/


$penduduk=mysqli_query($conn,"
SELECT *
FROM penduduk
ORDER BY nama ASC
");



$total=0;

$jumlah_layak=0;

$jumlah_tidak=0;



while($p=mysqli_fetch_assoc($penduduk)){


$id_penduduk=$p['id_penduduk'];



/*
====================================
AMBIL NILAI KRITERIA
====================================
*/


$data=mysqli_query($conn,"

SELECT

penilaian.nilai,

kriteria.nama_kriteria,

sub_kriteria.kategori_fuzzy


FROM penilaian


JOIN kriteria

ON penilaian.id_kriteria=kriteria.id_kriteria


JOIN sub_kriteria

ON penilaian.id_sub=sub_kriteria.id_sub


WHERE penilaian.id_penduduk='$id_penduduk'

");



$total_nilai=0;

$jml=0;



while($d=mysqli_fetch_assoc($data)){



$x=$d['nilai'];



/*
====================================
HITUNG FUZZIFIKASI
====================================
*/


$mu_rendah=fuzzyRendah($x,0,100);


$mu_sedang=fuzzySedang($x,50,100,150);


$mu_tinggi=fuzzyTinggi($x,100,200);



/*
====================================
SIMPAN DETAIL FUZZY
====================================
*/


mysqli_query($conn,"

INSERT INTO detail_fuzzy

(

id_penduduk,

nama_kriteria,

nilai,

kategori_fuzzy,

mu_rendah,

mu_sedang,

mu_tinggi

)


VALUES

(

'$id_penduduk',

'".$d['nama_kriteria']."',

'$x',

'".$d['kategori_fuzzy']."',

'$mu_rendah',

'$mu_sedang',

'$mu_tinggi'

)

");



$total_nilai += $x;

$jml++;



}



/*
====================================
DEFUZZIFIKASI CENTROID
====================================
*/


if($jml>0){

$nilai_akhir=$total_nilai/$jml;

}else{

$nilai_akhir=0;

}


$nilai_akhir=round($nilai_akhir,2);



/*
====================================
KEPUTUSAN
====================================
*/


if($nilai_akhir>=80){


$status="Sangat Layak";

$keterangan="Memenuhi seluruh kriteria bantuan sosial";


}

elseif($nilai_akhir>=60){


$status="Layak";

$keterangan="Layak menerima bantuan sosial";


}

elseif($nilai_akhir>=40){


$status="Kurang Layak";

$keterangan="Masih perlu pertimbangan";


}

else{


$status="Tidak Layak";

$keterangan="Tidak memenuhi kriteria";


}





/*
====================================
SIMPAN HASIL SELEKSI
====================================
*/


$tanggal=date("Y-m-d");



$cek=mysqli_query($conn,"

SELECT *

FROM hasil_seleksi

WHERE id_penduduk='$id_penduduk'

");



if(mysqli_num_rows($cek)>0){


mysqli_query($conn,"

UPDATE hasil_seleksi SET


nilai_akhir='$nilai_akhir',

status_kelayakan='$status',

keterangan='$keterangan',

tanggal_cetak='$tanggal'


WHERE id_penduduk='$id_penduduk'


");


}

else{


mysqli_query($conn,"

INSERT INTO hasil_seleksi

(

id_penduduk,

nilai_akhir,

status_kelayakan,

keterangan,

tanggal_cetak

)


VALUES

(

'$id_penduduk',

'$nilai_akhir',

'$status',

'$keterangan',

'$tanggal'

)


");


}




if($status=="Layak" || $status=="Sangat Layak"){


$jumlah_layak++;


}else{


$jumlah_tidak++;


}



$total++;



}





/*
====================================
SIMPAN RINGKASAN
====================================
*/


$_SESSION['total_proses']=$total;

$_SESSION['jumlah_layak']=$jumlah_layak;

$_SESSION['jumlah_tidak']=$jumlah_tidak;



echo "

<script>

alert('Semua data berhasil diproses');

window.location='hasil_semua.php';

</script>

";


?>