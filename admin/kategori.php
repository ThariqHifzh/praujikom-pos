<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['nama'])) {
    
    header("location:login.php?error=access-failed");
}

// munculkan / pilih sebuah atau semua kolom dari table user
$query = mysqli_query($koneksi, "SELECT * FROM category_product");
// mysqli_fetch_assoc($query) = unhtuk menjadikan hasil query menjadi sebuah data (object, array)

// jika parameternya ada ?delete=nilai parameter
if (isset($_GET['delete'])) {
    $id = $_GET['delete']; // mengambil nilai parameter

    // query / perintah hapus
    $delete = mysqli_query($koneksi, "DELETE FROM category_product WHERE id ='$id'");
    header("location:kategori.php?hapus=berhasil");
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
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card bg-transparent border-1 text-white" style="backdrop-filter: blur(10px); box-shadow: 0 0 15px 5px blueviolet;">
                                    <div class="card-header fw-bold" style="font-size: x-large;">Category</div>
                                    <div class="card-body">
                                        <?php if (isset($_GET['hapus'])): ?>
                                            <div class="alert alert-primary" role="alert">Data berhasil dihapus</div>
                                        <?php endif ?>
                                        <div class="mb-3" align="right">
                                            <a href="tambah-kategori.php" class="btn btn-primary" style="border-radius: 20px">Tambah</a>
                                        </div>
                                        <table class="table table-bordered text-white">
                                            <thead>
                                                <tr>
                                                    <th class="text-white">No</th>
                                                    <th class="text-white">Kategori</th>
                                                    <th class="text-white">Settings</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1;
                                                while ($row = mysqli_fetch_assoc($query)): ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $row['nama_kategori'] ?></td>
                                                        <td>
                                                            <a class="btn btn-success btn-sm"
                                                                href="tambah-kategori.php?edit=<?php echo $row['id'] ?>"><span class="tf-icon bx bx-pencil"></a>

                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Apakah Anda Yakin untuk Menghapus Data Ini?')"
                                                                href="kategori.php?delete=<?php echo $row['id'] ?>"><span class="tf-icon bx bx-trash"></a>
                                                        </td>
                                                    </tr>
                                                <?php endwhile ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>
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