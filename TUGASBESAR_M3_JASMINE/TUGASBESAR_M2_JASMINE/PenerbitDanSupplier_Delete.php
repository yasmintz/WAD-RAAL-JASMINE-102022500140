<?php
require "koneksi.php";

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    mysqli_query($conn, "DELETE FROM penerbit_supplier WHERE id = '$id'");
}

header("Location: PenerbitDanSupplier_Display.php");
exit();
?>