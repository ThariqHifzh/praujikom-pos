<?php
{
if ($password == $rowLogin['password']) {
    $_SESSION['nama'] = $rowLogin['nama'];
    $_SESSION['id'] = $rowLogin['id'];
    header("location:index.php");
} else {
    header("location:login.php?login=gagal");
}
} else {
header("location:login.php?login=gagal");
}

$email = $_SESSION['email'];

    $query = mysqli_query($koneksi, "SELECT id FROM users WHERE email = '$email'");
    $row = mysqli_fetch_assoc($query);

    <?php echo $rowLoginUser['foto'] ?>