<?php

include "../config/koneksi.php";


$id=$_GET['id'];


mysqli_query($conn,


"DELETE FROM hasil_fuzzy

WHERE id_hasil='$id'"


);


header("location:index.php");


?>