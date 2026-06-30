<?php

/* =====================================================
   FUNGSI UMUM
   Sistem Cek Bansos Fuzzy Mamdani
===================================================== */


/* ==========================================
   FORMAT RUPIAH
========================================== */

function rupiah($angka)
{
    if ($angka == "" || $angka === null) {
        $angka = 0;
    }

    return "Rp " . number_format((float)$angka, 0, ',', '.');
}


/* ==========================================
   FORMAT TANGGAL
========================================== */

function tanggal($tgl)
{
    if (empty($tgl) || $tgl == "0000-00-00") {
        return "-";
    }

    return date("d-m-Y", strtotime($tgl));
}


/* ==========================================
   MEMBERSIHKAN INPUT
========================================== */

function bersih($data)
{
    global $conn;

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

    if (isset($conn) && $conn instanceof mysqli) {
        $data = mysqli_real_escape_string($conn, $data);
    }

    return $data;
}


/* ==========================================
   CEK DATA KOSONG
========================================== */

function kosong($data)
{
    return empty(trim($data));
}


/* ==========================================
   FORMAT ANGKA
========================================== */

function angka($nilai)
{
    return number_format((float)$nilai, 2, '.', '');
}


/* ==========================================
   STATUS KELAYAKAN
========================================== */

function statusKelayakan($nilai)
{
    if ($nilai >= 80) {
        return "Sangat Layak";
    } elseif ($nilai >= 60) {
        return "Layak";
    } elseif ($nilai >= 40) {
        return "Kurang Layak";
    } else {
        return "Tidak Layak";
    }
}


/* ==========================================
   BADGE BOOTSTRAP
========================================== */

function badgeStatus($status)
{
    switch ($status) {

        case "Sangat Layak":
            return "<span class='badge bg-success'>Sangat Layak</span>";

        case "Layak":
            return "<span class='badge bg-primary'>Layak</span>";

        case "Kurang Layak":
            return "<span class='badge bg-warning text-dark'>Kurang Layak</span>";

        default:
            return "<span class='badge bg-danger'>Tidak Layak</span>";
    }
}

?>