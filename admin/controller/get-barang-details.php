<?php
require_once '../koneksi.php';

if (isset($_GET['id_barang'])) {
    $id_barang = $_GET['id_barang'];

    $query = mysqli_query($koneksi, "SELECT qty, harga FROM products WHERE id = '$id_barang'");

    
    if (mysqli_num_rows($query) > 0) {
            $item = mysqli_fetch_assoc($query);
        
            // kembalikan hasil dalam bentuk json
            header('Content-Type: application/json');
            echo json_encode($item);
    }
}