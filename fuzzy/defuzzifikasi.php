<?php

session_start();


if(!isset($_SESSION['inferensi'])){

    header("Location:inferensi.php");
    exit;

}



include "../config/koneksi.php";



$inferensi=$_SESSION['inferensi'];

$id_penduduk=$_SESSION['id_penduduk'];



include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";



$atas=0;

$bawah=0;



$data_centroid=array();



foreach($inferensi as $i){



switch($i['hasil']){


case "Tidak Layak":

$z=25;

break;


case "Kurang Layak":

$z=50;

break;


case "Layak":

$z=75;

break;


case "Sangat Layak":

$z=100;

break;



default:

$z=0;


}




$hasil_alpha_z=$i['alpha']*$z;



$atas += $hasil_alpha_z;


$bawah += $i['alpha'];



$data_centroid[]=array(

"rule"=>$i['id_rule'],

"alpha"=>$i['alpha'],

"z"=>$z,

"alpha_z"=>$hasil_alpha_z,

"hasil"=>$i['hasil']

);



}




if($bawah==0){


$nilai_akhir=0;


}else{


$nilai_akhir=$atas/$bawah;


}



$nilai_akhir=round($nilai_akhir,2);





/*
=================================
KEPUTUSAN
=================================
*/


if($nilai_akhir>=80){


$status="Sangat Layak";


$keterangan="Penduduk sangat layak menerima bantuan sosial";


}

elseif($nilai_akhir>=60){


$status="Layak";


$keterangan="Penduduk layak menerima bantuan sosial";


}

elseif($nilai_akhir>=40){


$status="Kurang Layak";


$keterangan="Penduduk masih perlu dipertimbangkan";


}

else{


$status="Tidak Layak";


$keterangan="Penduduk tidak layak menerima bantuan sosial";


}






/*
=================================
SIMPAN DATABASE
TABEL hasil_seleksi
=================================
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



}else{



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




?>





<div class="container-fluid">



<div class="card shadow">



<div class="card-header bg-success text-white">


<h4>

<i class="fa fa-calculator"></i>

Defuzzifikasi Centroid

</h4>


</div>




<div class="card-body">





<h5>

Tabel 7. Perhitungan Centroid

</h5>



<table class="table table-bordered table-striped">



<tr class="table-dark">


<th>No</th>

<th>Rule</th>

<th>α</th>

<th>z</th>

<th>α × z</th>

<th>Output</th>


</tr>




<?php


$no=1;


foreach($data_centroid as $d){



?>


<tr>


<td><?= $no++; ?></td>


<td>R<?= $d['rule']; ?></td>


<td><?= number_format($d['alpha'],2); ?></td>


<td><?= $d['z']; ?></td>


<td><?= number_format($d['alpha_z'],2); ?></td>


<td><?= $d['hasil']; ?></td>



</tr>


<?php } ?>



</table>







<h5 class="mt-4">

Rumus Centroid


</h5>




<table class="table table-bordered">


<tr>


<th>

Σ α × z

</th>


<td>

<?= number_format($atas,2); ?>

</td>


</tr>



<tr>


<th>

Σ α

</th>


<td>

<?= number_format($bawah,2); ?>

</td>


</tr>



<tr>


<th>

Z = Σ(α×z) / Σα

</th>


<td>


<b>

<?= $nilai_akhir; ?>

</b>


</td>


</tr>



</table>







<div class="text-center mt-4">


<h2>


<?php


if($status=="Sangat Layak"){


echo "<span class='badge bg-success'>$status</span>";


}elseif($status=="Layak"){


echo "<span class='badge bg-primary'>$status</span>";


}elseif($status=="Kurang Layak"){


echo "<span class='badge bg-warning text-dark'>$status</span>";


}else{


echo "<span class='badge bg-danger'>$status</span>";


}



?>


</h2>



<p>

<?= $keterangan; ?>

</p>



</div>






<a href="../hasil/index.php"

class="btn btn-dark">


<i class="fa fa-table"></i>

Lihat Hasil Seleksi


</a>




</div>


</div>


</div>





<?php


include "../template/footer.php";

include "../template/script.php";


?>