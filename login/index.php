<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login | Sistem Cek Bansos Fuzzy Mamdani</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>

body{

background:linear-gradient(135deg,#0d6efd,#198754);

height:100vh;

display:flex;

justify-content:center;

align-items:center;

font-family:'Segoe UI',sans-serif;

}


.card{

border:none;

border-radius:20px;

box-shadow:0 15px 40px rgba(0,0,0,.25);

overflow:hidden;

}


.logo{

width:90px;

height:90px;

border-radius:50%;

background:#0d6efd;

color:white;

display:flex;

align-items:center;

justify-content:center;

font-size:40px;

margin:auto;

margin-top:-60px;

border:6px solid white;

}


.card-header{

background:white;

border:none;

padding-top:0;

text-align:center;

}


.card-header h3{

font-weight:bold;

margin-top:15px;

}


.card-header p{

color:#777;

font-size:14px;

}


.form-control{

height:50px;

border-radius:10px;

}


.input-group-text{

border-radius:10px 0 0 10px;

}


.btn-login{

height:50px;

border-radius:10px;

font-weight:bold;

font-size:17px;

}


.footer{

text-align:center;

margin-top:20px;

font-size:13px;

color:#888;

}

</style>

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-4 col-md-6">

<div class="card">

<div class="card-header">

<div class="logo">

<i class="fas fa-hand-holding-heart"></i>

</div>

<h3>Sistem Cek Bansos</h3>

<p>Logika Fuzzy Mamdani</p>

</div>

<div class="card-body p-4">

<form action="proses_login.php" method="POST">

<div class="mb-3">

<label class="form-label">

Username

</label>

<div class="input-group">

<span class="input-group-text">

<i class="fa fa-user"></i>

</span>

<input type="text"

name="username"

class="form-control"

placeholder="Masukkan Username"

required>

</div>

</div>

<div class="mb-4">

<label class="form-label">

Password

</label>

<div class="input-group">

<span class="input-group-text">

<i class="fa fa-lock"></i>

</span>

<input type="password"

name="password"

class="form-control"

placeholder="Masukkan Password"

required>

</div>

</div>

<button class="btn btn-primary btn-login w-100">

<i class="fa fa-sign-in-alt"></i>

Login

</button>

</form>

<div class="footer">

© 2026 Sistem Cek Bansos Fuzzy Mamdani

</div>

</div>

</div>

</div>

</div>

</div>

</body>

</html>