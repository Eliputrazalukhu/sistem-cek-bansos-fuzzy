<?php

/* ===========================================================
   FUNGSI FUZZY MAMDANI
   Sistem Cek Bansos
=========================================================== */


/* ===========================================================
   FUZZY RENDAH
=========================================================== */

function fuzzyRendah($x, $a, $b)
{
    if ($b == $a) {
        return 0;
    }

    if ($x <= $a) {
        return 1;
    }

    if ($x >= $b) {
        return 0;
    }

    return ($b - $x) / ($b - $a);
}


/* ===========================================================
   FUZZY SEDANG
=========================================================== */

function fuzzySedang($x, $a, $b, $c)
{
    if ($a == $b || $b == $c) {
        return 0;
    }

    if ($x <= $a || $x >= $c) {
        return 0;
    }

    if ($x == $b) {
        return 1;
    }

    if ($x > $a && $x < $b) {

        return ($x - $a) / ($b - $a);

    }

    return ($c - $x) / ($c - $b);
}


/* ===========================================================
   FUZZY TINGGI
=========================================================== */

function fuzzyTinggi($x, $a, $b)
{
    if ($b == $a) {
        return 0;
    }

    if ($x <= $a) {
        return 0;
    }

    if ($x >= $b) {
        return 1;
    }

    return ($x - $a) / ($b - $a);
}


/* ===========================================================
   OPERATOR AND (MIN)
=========================================================== */

function fuzzyAND($a, $b)
{
    return min($a, $b);
}


/* ===========================================================
   OPERATOR OR (MAX)
=========================================================== */

function fuzzyOR($a, $b)
{
    return max($a, $b);
}


/* ===========================================================
   DEFUZZIFIKASI CENTROID
=========================================================== */

function defuzzifikasi($alpha, $z)
{
    $atas = 0;
    $bawah = 0;

    $jumlah = min(count($alpha), count($z));

    for($i=0; $i<$jumlah; $i++){

        $atas += ($alpha[$i] * $z[$i]);

        $bawah += $alpha[$i];

    }

    if($bawah == 0){

        return 0;

    }

    return round($atas / $bawah,2);

}


/* ===========================================================
   KATEGORI KELAYAKAN
=========================================================== */

function kategoriKelayakan($nilai)
{

    if($nilai >= 80){

        return "Sangat Layak";

    }

    elseif($nilai >= 60){

        return "Layak";

    }

    elseif($nilai >= 40){

        return "Dipertimbangkan";

    }

    else{

        return "Tidak Layak";

    }

}

?>