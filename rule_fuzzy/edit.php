<?php

session_start();

if(!isset($_SESSION['login'])){
header("Location:../login/index.php");
exit;
}

include "../config/koneksi.php";

$id=$_GET['id'];

$data=mysqli_query($conn,"
SELECT *
FROM rule_fuzzy
WHERE id_rule='$id'
");

$d=mysqli_fetch_assoc($data);

include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";

?>

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-warning">

<h4>Edit Rule Fuzzy</h4>

</div>

<div class="card-body">

<form action="update.php" method="POST">

<input type="hidden"
name="id"
value="<?= $d['id_rule']; ?>">

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

<select
name="<?= $name; ?>"
class="form-select">

<option <?=($d[$name]=='Rendah')?'selected':'';?>>Rendah</option>

<option <?=($d[$name]=='Sedang')?'selected':'';?>>Sedang</option>

<option <?=($d[$name]=='Tinggi')?'selected':'';?>>Tinggi</option>

</select>

</div>

<?php } ?>

<div class="mb-3">

<label>Hasil</label>

<select
name="hasil"
class="form-select">

<option <?=($d['hasil']=='Tidak Layak')?'selected':'';?>>Tidak Layak</option>

<option <?=($d['hasil']=='Kurang Layak')?'selected':'';?>>Kurang Layak</option>

<option <?=($d['hasil']=='Layak')?'selected':'';?>>Layak</option>

<option <?=($d['hasil']=='Sangat Layak')?'selected':'';?>>Sangat Layak</option>

</select>

</div>

<button class="btn btn-primary">

Update

</button>

<a href="index.php"
class="btn btn-secondary">

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