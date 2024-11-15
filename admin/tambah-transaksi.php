<?php
session_start();
session_regenerate_id(true);
date_default_timezone_set("Asia/Jakarta");
require_once "koneksi.php";



// Waktu :
$currentTime = date('Y-m-d');

// generate function (method)
function generateTransactionCode()
{
    $kode = date('dMyhis');

    return $kode;
}
// click count
if (empty($_SESSION['click_count'])) {
    $_SESSION['click_count'] = 0;
}

//Jika session nya isi, maka melempar ke dashboard.php
// if(isset($_SESSION['NAMALENGKAPNYA'])){
//     header("Location: kasir.php");
//     exit;
// }
?>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
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
                <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
                    <div class="card bg-transparent border-white shadow-lg p-3"
                        style="width: 100%; max-width: 900px; backdrop-filter: blur(10px);">
                        <div class="card-header border-white text-center">
                            <h1 class="fw-bold text-white" style="letter-spacing: -4px;">Add Transaction</h1>
                        </div>
                        <div class="card-body bg-transparent">
                            <form action="controller/transaksi-store.php" method="post">
                                <div class="mb-3">
                                    <label for="kode_transaksi" class="form-label text-white">No. Transaksi</label>
                                    <input style="border-radius: 20px;" class="form-control bg-transparent text-white"
                                        name="kode_transaksi" id="kode_transaksi" type="text"
                                        value="<?php echo 'TR-' . generateTransactionCode(); ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_transaksi" class="form-label text-white">Tanggal
                                        Transaksi</label>
                                    <input style="border-radius: 20px;" class="form-control bg-transparent text-white"
                                        name="tanggal_transaksi" id="tanggal_transaksi" type="date"
                                        value="<?php echo $currentTime; ?>" readonly>
                                </div>
                                <div class="mb-3 d-flex align-items-center">
                                    <button style="border-radius: 20px;" class="btn btn-primary me-3 " type="button"
                                        id="counterBtn">Tambah</button>
                                    <!-- <input type="number" class="form-control text-light bg-transparent text-light"
                            style="width:50px; border-radius: 20px;" name="countDisplay"
                            value=" echo $_SESSION['click_count']; ?>" id="countDisplay" readonly> -->
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-primary">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Kategori</th>
                                                <th>Nama Barang</th>
                                                <th>Qty</th>
                                                <th>Sisa Produk</th>
                                                <th>Harga</th>
                                                <th>Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            <!-- Data ditambah disini -->
                                        </tbody>
                                        <tfoot class="text-center">
                                            <tr>
                                                <th colspan="6">Total Harga</th>
                                                <td><input type="number" id="total_harga_keseluruhan" name="total_harga"
                                                        class="form-control border-white bg-transparent" readonly></td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">Nominal Bayar</th>
                                                <td><input type="number" id="nominal_bayar_keseluruhan"
                                                        name="nominal_bayar"
                                                        class="form-control border-white bg-transparent" required></td>
                                            </tr>
                                            <tr>
                                                <th colspan="6">Kembalian</th>
                                                <td><input type="number"
                                                        class="form-control border-white bg-transparent"
                                                        id="kembalian_keseluruhan" name="kembalian" readonly></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="text-center mt-4">
                                    <input type="submit" class="btn btn-primary me-3" name="simpan" value="Hitung"
                                        style="border-radius: 20px">
                                    <a class="btn btn-danger" href="kasir.php" style="border-radius: 20px">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
    $query = mysqli_query($koneksi, "SELECT * FROM category_product");
    $categories = mysqli_fetch_all($query, MYSQLI_ASSOC);
    ?>
                <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Function to add a new row
                    const button = document.getElementById('counterBtn');
                    const countDisplay = document.getElementById('countDisplay');
                    const tbody = document.getElementById('tbody');
                    const table = document.getElementById('table');

                    let no = 0;
                    button.addEventListener('click', function() {
                        no++;

                        // Add new row HTML
                        let newRow = "<tr>";
                        newRow += `<td>${no}</td>`;
                        newRow +=
                            `<td><select class='form-control category-select' name='id_kategori[]' type='number' required>`;
                        newRow += "<option value=''>--Pilih Kategori--</option>";
                        <?php foreach ($categories as $category) { ?>
                        newRow +=
                            `<option value='<?php echo $category['id']; ?>'><?php echo $category['nama_kategori']; ?></option>`;
                        <?php } ?>
                        newRow += "</select></td>";
                        newRow +=
                            `<td><select class='form-control item-select' name='id_barang[]' type='number' required>`;
                        newRow += "<option value=''>--Pilih Barang--</option></select></td>";

                        newRow +=
                            "<td><input type='number' name='qty[]' class='form-control jumlah-input' value='0' required></td>";
                        newRow +=
                            "<td><input type='number' name='sisa_produk[]' class='form-control' value='0' readonly></td>";
                        newRow +=
                            "<td><input type='number' name='harga[]' class='form-control' readonly></td>";
                        newRow +=
                            "<td><input type='number' name='sub_total[]' class='form-control sub-total' readonly></td>";
                        newRow += "</tr>";

                        tbody.insertAdjacentHTML('beforeend', newRow);

                        attachCategoryChangeListener();
                        attachItemChangeListener();
                        attachJumlahChangeListener();
                    });

                    // Function to display items based on category
                    function attachCategoryChangeListener() {
                        const categorySelects = document.querySelectorAll('.category-select');
                        categorySelects.forEach(select => {
                            select.addEventListener('change', function() {
                                const categoryId = this.value;
                                const itemSelect = this.closest('tr').querySelector(
                                    '.item-select');

                                if (categoryId) {
                                    fetch(
                                            `controller/get-product-dari-category.php?id_kategori=${categoryId}`
                                        )
                                        .then(response => response.json())
                                        .then(data => {
                                            itemSelect.innerHTML =
                                                "<option value=''>--Pilih Barang--</option>";
                                            data.forEach(item => {
                                                itemSelect.innerHTML +=
                                                    `<option value='${item.id}'>${item.nama_barang}</option>`;
                                            });
                                        });
                                } else {
                                    itemSelect.innerHTML =
                                        "<option value=''>--Pilih Barang--</option>";
                                }
                            });
                        });
                    }

                    // Function to set quantity and price based on selected item
                    function attachItemChangeListener() {
                        const itemSelects = document.querySelectorAll('.item-select');
                        itemSelects.forEach(select => {
                            select.addEventListener('change', function() {
                                const itemId = this.value;
                                const row = this.closest('tr');
                                const sisaProdukInput = row.querySelector(
                                    'input[name="sisa_produk[]"]');
                                const hargaInput = row.querySelector('input[name="harga[]"]');

                                if (itemId) {
                                    fetch(
                                            `controller/get-barang-details.php?id_barang=${itemId}`
                                        )
                                        .then(response => response.json())
                                        .then(data => {
                                            sisaProdukInput.value = data.qty;
                                            hargaInput.value = data.harga;
                                        });
                                } else {
                                    sisaProdukInput.value = '';
                                    hargaInput.value = '';
                                }
                            });
                        });
                    }

                    const totalHargaKeseluruhan = document.getElementById('total_harga_keseluruhan');
                    const nominalBayarKeseluruhanInput = document.getElementById('nominal_bayar_keseluruhan');
                    const kembaliKeseluruhanInput = document.getElementById('kembalian_keseluruhan');

                    // Function to alert if jumlah > sisaProduk
                    function attachJumlahChangeListener() {
                        const jumlahInputs = document.querySelectorAll('.jumlah-input');
                        jumlahInputs.forEach(input => {
                            input.addEventListener('input', function() {
                                const row = this.closest('tr');
                                const sisaProdukInput = row.querySelector(
                                    'input[name="sisa_produk[]"]');
                                const hargaInput = row.querySelector('input[name="harga[]"]');

                                const jumlah = parseInt(this.value) || 0;
                                const sisaProduk = parseInt(sisaProdukInput.value) || 0;
                                const harga = parseFloat(hargaInput.value) || 0;

                                if (jumlah > sisaProduk) {
                                    alert("Jumlah tidak boleh melebihi sisa produk");
                                    this.value = sisaProduk;
                                    return;
                                }
                                updateTotalKeseluruhan();
                            });
                        });
                    }

                    // Function to update the total price
                    function updateTotalKeseluruhan() {
                        let totalKeseluruhan = 0;

                        document.querySelectorAll('#tbody tr').forEach(row => {
                            const jumlah = parseInt(row.querySelector('.jumlah-input').value) || 0;
                            const harga = parseFloat(row.querySelector('input[name="harga[]"]')
                                .value) || 0;
                            const subtotal = jumlah * harga;

                            row.querySelector('.sub-total').value = subtotal;
                            totalKeseluruhan += subtotal;
                        });

                        totalHargaKeseluruhan.value = totalKeseluruhan;
                    }

                    // Calculate change
                    nominalBayarKeseluruhanInput.addEventListener('input', function() {
                        const nominalBayar = parseFloat(this.value) || 0;
                        const totalHarga = parseFloat(totalHargaKeseluruhan.value) || 0;
                        kembaliKeseluruhanInput.value = nominalBayar - totalHarga;

                        if (nominalbayar >= totalHarga) {
                            let kembalian = nominalBayar - totalHarga;
                            kembaliKeseluruhanInput.value = kembalian;
                        } else if (nominalBayar == 0) {
                            kembalianKeseluruhanInput.value = 0;
                        }
                    });
                });
                </script>
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