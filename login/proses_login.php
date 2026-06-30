<?php

session_start();

include "../config/koneksi.php";


$username = $_POST['username'];
$password = md5($_POST['password']);


$query = mysqli_query($conn,

"SELECT * FROM users 
WHERE username='$username'
AND password='$password'"

);


$data = mysqli_fetch_assoc($query);



if($data){


$_SESSION['id_user'] = $data['id_user'];

$_SESSION['nama'] = $data['nama'];

$_SESSION['role'] = $data['role'];

$_SESSION['login'] = true;



header("location:../admin/dashboard.php");


}else{


echo "

<script>

alert('Username atau Password Salah');

window.location='index.php';

</script>

";


}


?>