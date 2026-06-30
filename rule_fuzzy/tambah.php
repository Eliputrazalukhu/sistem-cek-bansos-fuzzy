<?php

session_start();

if(!isset($_SESSION['login'])){
header("Location:../login/index.php");
exit;
}

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h4>

Tambah Rule Fuzzy

</h4>

</div>

<div class="card-body">

<form action="simpan.php" method="POST">

<?php

$field=array(

"Aset"=>"aset",
"Rumah"=>"rumah",
"Kondisi Lantai"=>"lantai",
"Kondisi Dinding"=>"dinding",
"Kepemilikan Rumah"=>"kepemilikan",
"Pekerjaan"=>"pekerjaan",
"Penghasilan"=>"penghasilan",
"Tanggungan"=>"tanggungan",
"Syarat Lain"=>"syarat_lain"

);

foreach($field as $label=>$name){

?>

<div class="mb-3">

<label><?= $label; ?></label>

<select name="<?= $name; ?>" class="form-select">

<option>Rendah</option>
<option>Sedang</option>
<option>Tinggi</option>

</select>

</div>

<?php } ?>

<div class="mb-3">

<label>Hasil Rule</label>

<select name="hasil" class="form-select">

<option>Tidak Layak</option>

<option>Kurang Layak</option>

<option>Layak</option>

<option>Sangat Layak</option>

</select>

</div>

<button class="btn btn-success">

Simpan

</button>

<a href="index.php" class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

<?php

include "../template/footer.php";
include "../template/script.php";

?>