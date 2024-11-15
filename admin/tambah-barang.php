<?php
session_start();
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama_barang'];
    $id_kategori   = $_POST['id_kategori'];
    $satuan   = $_POST['satuan'];
    $qty  = $_POST['qty'];
    $harga  = $_POST['harga'];
    
    // sql = structur query languages / DML = data manipulation language
    // select, insert, update, delete
    $insert = mysqli_query($koneksi, "INSERT INTO products (nama_barang, id_kategori, satuan, qty, harga) VALUES
    ('$nama', '$id_kategori', '$satuan', '$qty', '$harga')");
    header("location:barang.php?tambah=berhasil");
}

$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$editUser = mysqli_query(
    $koneksi,
    "SELECT * FROM products WHERE id = '$id'"
);
$rowEdit = mysqli_fetch_assoc($editUser);

if (isset($_POST['edit'])) {
    $nama   = $_POST['nama_barang'];
    $id_kategori   = $_POST['id_kategori'];
    $satuan   = $_POST['satuan'];
    $qty  = $_POST['qty'];
    $harga  = $_POST['harga'];
    
    // ubah user kolom apa yang mau di ubah (SET), yang mau di ubah id ke berapa
    $update = mysqli_query($koneksi, "UPDATE products SET nama_barang='$nama',id_kategori='$id_kategori', satuan='$satuan', qty='$qty'  WHERE id='$id'");
    header("location:barang.php?&ubah=berhasil");
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $delete = mysqli_query($koneksi, "DELETE FROM products WHERE id='$id'");
    header("location:barang.php?&hapus=berhasil");
}


$queryKategori = mysqli_query($koneksi, "SELECT * FROM category_product");

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
                                <div class="card bg-transparent border-1 border-white" style="backdrop-filter: blur(10px); box-shadow: 0 0 15px 5px blueviolet;">
                                    <div class="card-body">
                                        <legend class="float-none w-auto px-3 fw-bold text-white">
                                            <?php echo isset($_GET['edit']) ? 'Edit' : 'Tambah' ?> Product</legend>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="" class="form-label text-white">Kategori</label>
                                                <select name="id_kategori" id="" class="form-control">
                                                    <option value="">Pilih Kategori</option>

                                                    <!-- option yang datanya di ambil dari table kategori -->

                                                    <?php while ($rowKategori = mysqli_fetch_assoc($queryKategori)): ?>
                                                        <option
                                                            <?php echo isset($_GET['edit']) ? ($rowKategori['id'] == $rowEdit['id_kategori'] ? 'selected' : '') : '' ?>
                                                            value="<?php echo $rowKategori['id'] ?>">
                                                            <?php echo $rowKategori['nama_kategori'] ?></option>
                                                    <?php endwhile ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-6 ">
                                                <label for="" class="form-label text-white">Nama</label>
                                                <input type="text" class="form-control" name="nama_barang" placeholder="Masukkan Nama Anda" required value="<?php echo isset($_GET['edit']) ? $rowEdit['nama_barang'] : '' ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="" class="form-label text-white">Satuan</label>
                                                <input type="text" class="form-control" name="satuan" placeholder="Masukkan Satuan" required value="<?php echo isset($_GET['edit']) ? $rowEdit['satuan'] : '' ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="" class="form-label text-white">Qty</label>
                                                <input type="text" class="form-control" name="qty" placeholder="Masukkan Quantity" required value="<?php echo isset($_GET['edit']) ? $rowEdit['qty'] : '' ?>">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="" class="form-label text-white">Harga</label>
                                                <input type="number" class="form-control" name="harga" placeholder="Masukkan Harga" required value="<?php echo isset($_GET['edit']) ? $rowEdit['harga'] : '' ?>">
                                            </div>
                                            <div class="mb-3 mt-5">
                                                <button class="btn btn-primary" name="<?php echo isset($_GET['edit']) ? 'edit' : 'simpan' ?>" type="submit">Simpan</button>
                                            </div>
                                        </form>
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