<?php
session_start();
require_once "../koneksi.php";

if (isset($_POST['simpan'])) {
    $id_user = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';

    $kode_transaksi = $_POST['kode_transaksi'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];
    $total_harga = $_POST['total_harga'];
    $nominal_bayar = $_POST['nominal_bayar'];
    $kembalian = $_POST['kembalian'];


    $queryPenjualan = mysqli_query($koneksi, "INSERT INTO sales (kode_transaksi, tanggal_transaksi, total_harga, nominal_bayar, kembalian) VALUES ('$kode_transaksi', '$tanggal_transaksi', '$total_harga', '$nominal_bayar', '$kembalian')");
    
    $id_sales= mysqli_insert_id($koneksi);

  
    foreach ($_POST['id_barang'] as $key => $id_barang) {
        $qty = $_POST['qty'][$key];
        $sub_total = $_POST['sub_total'][$key];

        $detailPenjualan = mysqli_query($koneksi, "INSERT INTO detail_sales (id_sales, id_barang, qty, sub_total) VALUES ('$id_sales',  '$id_barang', '$qty', '$sub_total')");

        
        $updateQty = mysqli_query($koneksi, "UPDATE products SET qty = qty - $qty WHERE id = $id_barang");
    }

    
    header("Location: ../print.php?id=" . $id_sales);
    exit();
}