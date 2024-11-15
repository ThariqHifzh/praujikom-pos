<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nama'])) {
    
    header("location:login.php?error=access-failed");
}

// munculkan / pilih sebuah atau semua kolom dari table user
$queryUser = mysqli_query($koneksi, "SELECT * FROM sales");
// mysqli_fetch_assoc($query) = unhtuk menjadikan hasil query menjadi sebuah data (object, array)

// jika parameternya ada ?delete=nilai parameter
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; // mengambil nilai parameter

    // query / perintah hapus
    $delete = mysqli_query($koneksi, "DELETE FROM sales WHERE id ='$id'");
    header("location:kasir.php?hapus=berhasil");
}
?>


<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <?php include 'inc/head.php'; ?>
</head>

<body style="background-image: url(../image/123.jpg); background-size:cover">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <?php include 'inc/sidebar.php'; ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <?php include 'inc/navbar.php'; ?>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="container justify-content-center position-absolute ms-3" style="margin-top: 100px;">
            <div class="col-12">
                <div class="card bg-transparent border-1 border-white" style="backdrop-filter: blur(15px); box-shadow: 0 0 15px 5px blueviolet;">
                    <div class=" card-header text-center border-white">
                        <h1 style="letter-spacing: -3px" class="fw-bold text-white">Detail Kasir</h1>
                    </div>
                    <div class="card-body">
                        <div class="table table-responsive">
                        <?php if ($_SESSION['id_level'] == 3) : ?>
                            <div class="mt-2 mb-3">
                                <a href="tambah-transaksi.php" class="btn btn-primary btn-sm"
                                    style="border-radius: 20px">Tambah Transaksi</a>
                            </div>
                            <?php endif ?>
                            <table class=" table table-bordered bg-transparent">
                                <thead>
                                    <tr>
                                        <th class="text-white">No</th>
                                        <th class="text-white">Kode Transaksi</th>
                                        <th class="text-white">Tanggal Transaksi</th>
                                        <th class="text-white">Total Harga</th>
                                        <th class="text-white">Nominal Pembayaran</th>
                                        <th class="text-white">Kembalian</th>
                                        <?php if ($_SESSION['id_level'] == 3) : ?>
                                        <th class="text-white">Settings</th>
                                        <?php endif ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; while ($rowUser = mysqli_fetch_assoc($queryUser)): ?>
                                    <tr class="text-white">
                                        <td ><?php echo $no++ ?></td>
                                        <td><?php echo $rowUser['kode_transaksi'] ?></td>
                                        <td><?php echo $rowUser['tanggal_transaksi'] ?></td>
                                        <td><?php echo "Rp. " . number_format($rowUser['total_harga']) ?></td>
                                        <td><?php echo "Rp. " . number_format($rowUser['nominal_bayar']) ?></td>
                                        <td><?php echo "Rp. " . number_format($rowUser['kembalian']) ?></td>
                                        <?php if ($_SESSION['id_level'] == 3) : ?>
                                        <td>
                                            <a class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda Yakin untuk Menghapus Data Ini?')"
                                                href="kasir.php?delete=<?php echo $rowUser['id'] ?>">Delete</a>
                                        </td>
                                        <?php endif ?>
                                    </tr>
                                    <?php endwhile ?>
                                    
                                </tbody>
                            </table>
                            <?php if ($_SESSION['id_level'] == 2) : ?>
                                        <td>
                                        <a href="print-semua.php" type="submit" class="btn-sm btn-primary text-white px-4" name="simpan" value="Hitung"
                                        style="border-radius: 20px; margin-top: 50px; margin-left: 600px;">Print</a>
                                    </td>
                                    <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/admin/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/admin/assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/admin/assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/admin/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/admin/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/admin/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/admin/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>