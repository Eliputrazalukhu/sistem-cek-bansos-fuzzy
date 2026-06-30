<?php

session_start();


if(!isset($_SESSION['login'])){

    header("Location:../login/index.php");
    exit;

}


include "../config/koneksi.php";



/*
=====================================
 CEK ID PENDUDUK
=====================================
*/


if(!isset($_POST['id_penduduk'])){

    die("ID Penduduk tidak ditemukan");

}


$id_penduduk = $_POST['id_penduduk'];



/*
=====================================
 AMBIL DATA PENILAIAN PENDUDUK
=====================================
*/


$query = mysqli_query($conn,"


SELECT


penilaian.id_penilaian,

penilaian.id_penduduk,

penilaian.id_kriteria,

penilaian.id_sub,

penilaian.nilai,


kriteria.kode_kriteria,

kriteria.nama_kriteria,


sub_kriteria.nama_sub,

sub_kriteria.kategori_fuzzy


FROM penilaian


JOIN kriteria

ON penilaian.id_kriteria=kriteria.id_kriteria



JOIN sub_kriteria

ON penilaian.id_sub=sub_kriteria.id_sub



WHERE penilaian.id_penduduk='$id_penduduk'


ORDER BY kriteria.id_kriteria ASC



");



if(!$query){


    die("Query Error : ".mysqli_error($conn));


}



/*
=====================================
 MASUKKAN KE ARRAY FUZZY
=====================================
*/


$data_fuzzy=array();



while($data=mysqli_fetch_assoc($query)){



$data_fuzzy[]=array(


"id_penilaian"=>$data['id_penilaian'],


"id_penduduk"=>$data['id_penduduk'],


"id_kriteria"=>$data['id_kriteria'],


"nama_kriteria"=>$data['nama_kriteria'],


"kode_kriteria"=>$data['kode_kriteria'],


"nilai"=>$data['nilai'],


"nama_sub"=>$data['nama_sub'],


"kategori_fuzzy"=>$data['kategori_fuzzy']


);



}




/*
=====================================
 CEK DATA
=====================================
*/


if(count($data_fuzzy)==0){


echo "

<script>

alert('Penduduk belum memiliki nilai kriteria');

window.location='index.php';

</script>


";


exit;


}



/*
=====================================
 SIMPAN SESSION
=====================================
*/


$_SESSION['id_penduduk']=$id_penduduk;


$_SESSION['nilai']=$data_fuzzy;



/*
=====================================
 MASUK KE FUZZIFIKASI
=====================================
*/


header("Location:fuzzyfikasi.php");

exit;


?>