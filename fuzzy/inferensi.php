<?php

session_start();


if(!isset($_SESSION['fuzzifikasi'])){

    header("Location:fuzzyfikasi.php");
    exit;

}


include "../config/koneksi.php";


$fuzzifikasi=$_SESSION['fuzzifikasi'];



include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";



$hasil_inferensi=array();


?>



<div class="container-fluid">


<div class="card shadow">


<div class="card-header bg-warning">


<h4>

<i class="fa fa-sitemap"></i>

Inferensi Fuzzy Mamdani

</h4>


</div>



<div class="card-body">





<!-- ==============================
TABEL 6 RULE FUZZY
============================== -->


<h5>

Tabel 6. Evaluasi Rule Fuzzy

</h5>



<table class="table table-bordered table-striped">



<thead class="table-dark">


<tr>


<th>No</th>

<th>Rule</th>

<th>Kondisi</th>

<th>Alpha Predikat</th>

<th>Status</th>

<th>Keputusan</th>


</tr>


</thead>



<tbody>



<?php



$rule=mysqli_query($conn,"

SELECT *

FROM rule_fuzzy

ORDER BY id_rule ASC

");



$no=1;



while($r=mysqli_fetch_assoc($rule)){



/*
=================================
AMBIL NILAI MINIMUM
OPERATOR AND
=================================
*/


$alpha=1;



foreach($fuzzifikasi as $f){



$alpha=min(

$alpha,

max(

$f['rendah'],

$f['sedang'],

$f['tinggi']

)

);



}



$alpha=round($alpha,2);




/*
==============================
TRUE FALSE
==============================
*/


if($alpha>0){


$status="TRUE";


}else{


$status="FALSE";


}




$hasil_inferensi[]=array(


"id_rule"=>$r['id_rule'],

"alpha"=>$alpha,

"hasil"=>$r['hasil']


);



?>



<tr>


<td>

<?= $no++; ?>

</td>



<td>

R<?= $r['id_rule']; ?>

</td>



<td>


IF

<br>


<?= $r['aset']; ?>


AND


<?= $r['rumah']; ?>


AND


<?= $r['penghasilan']; ?>


<br>


THEN


<br>


<b>

<?= $r['hasil']; ?>

</b>


</td>



<td>


<?= number_format($alpha,2); ?>


</td>



<td>


<?php


if($status=="TRUE"){


echo "

<span class='badge bg-success'>

TRUE

</span>

";


}else{


echo "

<span class='badge bg-danger'>

FALSE

</span>

";


}


?>


</td>



<td>


<?= $r['hasil']; ?>


</td>



</tr>



<?php } ?>



</tbody>



</table>





<?php


$_SESSION['inferensi']=$hasil_inferensi;



?>






<!-- ==============================
RINGKASAN
============================== -->


<div class="card mt-4">


<div class="card-header bg-info text-white">


Ringkasan Inferensi


</div>



<div class="card-body">



<table class="table table-bordered">



<tr>


<th>

Jumlah Rule Aktif

</th>


<td>


<?php


$aktif=0;


foreach($hasil_inferensi as $h){


if($h['alpha']>0){

$aktif++;

}


}


echo $aktif;


?>


</td>


</tr>




<tr>


<th>

Operator Digunakan


</th>


<td>

AND (MIN)

</td>


</tr>




<tr>


<th>

Metode


</th>


<td>

Mamdani

</td>


</tr>



</table>


</div>


</div>





<a href="defuzzifikasi.php"

class="btn btn-success mt-3">


<i class="fa fa-calculator"></i>

Lanjut Defuzzifikasi


</a>





</div>


</div>


</div>




<?php


include "../template/footer.php";

include "../template/script.php";


?>