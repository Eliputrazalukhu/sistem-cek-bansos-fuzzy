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

<i class="fas fa-user-plus"></i>

Tambah Data Penduduk

</h4>

</div>

<div class="card-body">

<form action="simpan.php" method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

NIK

</label>

<input

type="text"

name="nik"

class="form-control"

maxlength="16"

placeholder="Masukkan NIK"

required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Nama Lengkap

</label>

<input

type="text"

name="nama"

class="form-control"

placeholder="Masukkan Nama"

required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Jenis Kelamin

</label>

<select

name="jenis_kelamin"

class="form-select"

required>

<option value="">-- Pilih --</option>

<option value="Laki-laki">Laki-laki</option>

<option value="Perempuan">Perempuan</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Tempat Lahir

</label>

<input

type="text"

name="tempat_lahir"

class="form-control"

required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Tanggal Lahir

</label>

<input

type="date"

name="tanggal_lahir"

class="form-control"

required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Desa

</label>

<input

type="text"

name="desa"

class="form-control"

required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Kecamatan

</label>

<input

type="text"

name="kecamatan"

class="form-control"

required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Pekerjaan

</label>

<input

type="text"

name="pekerjaan"

class="form-control"

required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Nomor HP

</label>

<input

type="text"

name="no_hp"

class="form-control"

placeholder="08xxxxxxxxxx">

</div>

<div class="col-md-12 mb-3">

<label class="form-label">

Alamat Lengkap

</label>

<textarea

name="alamat"

class="form-control"

rows="4"

required></textarea>

</div>

</div>

<hr>

<button

type="submit"

class="btn btn-success">

<i class="fas fa-save"></i>

Simpan

</button>

<a

href="index.php"

class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

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