<?php

session_start();


if(!isset($_SESSION['login'])){

header("Location:../login/index.php");

exit;

}


include "../config/koneksi.php";



$data=mysqli_query($conn,"


SELECT


hasil_seleksi.*,


penduduk.nik,

penduduk.nama,

penduduk.alamat,

penduduk.pekerjaan



FROM hasil_seleksi



JOIN penduduk


ON hasil_seleksi.id_penduduk=penduduk.id_penduduk



ORDER BY nilai_akhir DESC



");



include "../template/header.php";

include "../template/navbar.php";

include "../template/sidebar.php";



?>



<div class="container-fluid">



<div class="card shadow">



<div class="card-header bg-success text-white">



<div class="d-flex justify-content-between">


<h4>

<i class="fa fa-award"></i>

Hasil Seleksi Bansos Fuzzy Mamdani


</h4>



<a href="../laporan/index.php"

class="btn btn-light">


<i class="fa fa-print"></i>

Cetak Laporan


</a>


</div>



</div>




<div class="card-body">






<!-- ===========================
RINGKASAN
=========================== -->


<div class="row mb-4">



<div class="col-md-4">


<div class="card bg-primary text-white">


<div class="card-body text-center">


<h2>


<?= mysqli_num_rows($data); ?>


</h2>


<p>

Total Seleksi

</p>


</div>


</div>


</div>




<div class="col-md-4">


<div class="card bg-success text-white">


<div class="card-body text-center">


<h2>


<?php


mysqli_data_seek($data,0);


$jml=0;


while($x=mysqli_fetch_assoc($data)){


if(

$x['status_kelayakan']=="Layak"

||

$x['status_kelayakan']=="Sangat Layak"

){


$jml++;


}


}


echo $jml;



?>


</h2>


<p>

Layak Menerima Bantuan

</p>


</div>


</div>


</div>





<div class="col-md-4">


<div class="card bg-danger text-white">


<div class="card-body text-center">


<h2>


<?php



mysqli_data_seek($data,0);


$tidak=0;



while($x=mysqli_fetch_assoc($data)){



if($x['status_kelayakan']=="Tidak Layak"){



$tidak++;


}



}


echo $tidak;



?>


</h2>


<p>

Tidak Layak

</p>


</div>


</div>


</div>




</div>









<h5>

Tabel Hasil Perhitungan Fuzzy Mamdani

</h5>



<div class="table-responsive">



<table class="table table-bordered table-striped table-hover">



<thead class="table-dark">



<tr>



<th>No</th>

<th>NIK</th>

<th>Nama</th>

<th>Pekerjaan</th>

<th>Alamat</th>

<th>Nilai Akhir</th>

<th>Status</th>

<th>Keterangan</th>

<th>Tanggal</th>



</tr>


</thead>



<tbody>



<?php



mysqli_data_seek($data,0);



$no=1;



while($d=mysqli_fetch_assoc($data)){



?>



<tr>



<td>

<?= $no++; ?>

</td>



<td>

<?= $d['nik']; ?>

</td>



<td>

<?= $d['nama']; ?>

</td>



<td>

<?= $d['pekerjaan']; ?>

</td>



<td>

<?= $d['alamat']; ?>

</td>




<td>


<b>

<?= number_format($d['nilai_akhir'],2); ?>

</b>


</td>




<td>



<?php


if($d['status_kelayakan']=="Sangat Layak"){



echo "

<span class='badge bg-success'>

Sangat Layak

</span>

";


}


elseif($d['status_kelayakan']=="Layak"){



echo "

<span class='badge bg-primary'>

Layak

</span>

";


}


elseif($d['status_kelayakan']=="Kurang Layak"){



echo "

<span class='badge bg-warning text-dark'>

Kurang Layak

</span>

";


}


else{



echo "

<span class='badge bg-danger'>

Tidak Layak

</span>

";


}


?>



</td>




<td>

<?= $d['keterangan']; ?>

</td>




<td>

<?= date("d-m-Y",strtotime($d['tanggal_cetak'])); ?>

</td>




</tr>



<?php } ?>



</tbody>



</table>



</div>



</div>


</div>


</div>




<?php


include "../template/footer.php";

include "../template/script.php";


?>