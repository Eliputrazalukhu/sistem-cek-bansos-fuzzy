<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location:../login/index.php");
    exit;
}

include "../config/koneksi.php";
include "../template/header.php";
include "../template/navbar.php";
include "../template/sidebar.php";
?>


<a href="proses_semua.php" 
class="btn btn-danger">

<i class="fa fa-cogs"></i>

Proses Semua Data Fuzzy

</a>



<div class="container-fluid">

    <div class="card shadow mb-4">

        <div class="card-header bg-primary text-white">

            <div class="d-flex justify-content-between align-items-center">

                <h4 class="mb-0">
                    <i class="fas fa-project-diagram"></i>
                    Proses Fuzzy Mamdani
                </h4>

            </div>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                    <tr>

                        <th width="5%">No</th>

                        <th>NIK</th>

                        <th>Nama Penduduk</th>

                        <th>Jenis Kelamin</th>

                        <th>Pekerjaan</th>

                        <th>Alamat</th>

                        <th width="15%">Aksi</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php

                    $no = 1;

                    $query = mysqli_query($conn, "
                        SELECT *
                        FROM penduduk
                        ORDER BY nama ASC
                    ");

                    while($d = mysqli_fetch_assoc($query)){
                    ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td><?= htmlspecialchars($d['nik']); ?></td>

                        <td><?= htmlspecialchars($d['nama']); ?></td>

                        <td><?= htmlspecialchars($d['jenis_kelamin']); ?></td>

                        <td><?= htmlspecialchars($d['pekerjaan']); ?></td>

                        <td><?= htmlspecialchars($d['alamat']); ?></td>

                        <td class="text-center">

                            <form action="proses.php" method="POST">

                                <input
                                    type="hidden"
                                    name="id_penduduk"
                                    value="<?= $d['id_penduduk']; ?>">

                                <button
                                    type="submit"
                                    class="btn btn-success btn-sm">

                                    <i class="fas fa-play"></i>
                                    Proses Fuzzy

                                </button>

                            </form>

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