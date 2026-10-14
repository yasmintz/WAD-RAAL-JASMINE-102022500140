<?php
require "koneksi.php";

$penerbit = $supplier = $kontak = $alamat = "";
$penerbitErr = $supplierErr = $kontakErr = $alamatErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $penerbit = trim($_POST["nama_penerbit"]);
    if (empty($penerbit)) {
        $penerbitErr = "Nama Penerbit wajib diisi";
    }

    $supplier = trim($_POST["nama_supplier"]);
    if (empty($supplier)) {
        $supplierErr = "Nama Supplier wajib diisi";
    }

    $kontak = trim($_POST["kontak_sales"]);
    if (empty($kontak)) {
        $kontakErr = "Kontak Sales wajib diisi";
    } elseif (!preg_match("/^[0-9]+$/", $kontak)) {
        $kontakErr = "Kontak Sales hanya boleh berisi angka";
    }

    $alamat = trim($_POST["alamat"]);
    if (empty($alamat)) {
        $alamatErr = "Alamat wajib diisi";
    }

    if (empty($penerbitErr) && empty($supplierErr) && empty($kontakErr) && empty($alamatErr)) {

        $penerbitSafe = mysqli_real_escape_string($conn, $penerbit);
        $supplierSafe = mysqli_real_escape_string($conn, $supplier);
        $kontakSafe   = mysqli_real_escape_string($conn, $kontak);
        $alamatSafe   = mysqli_real_escape_string($conn, $alamat);

        $sql = "INSERT INTO penerbit_supplier (nama_penerbit, nama_supplier, kontak_sales, alamat, status)
                VALUES ('$penerbitSafe', '$supplierSafe', '$kontakSafe', '$alamatSafe', 'Diproses')";

        if (mysqli_query($conn, $sql)) {
            header("Location: PenerbitDanSupplier_Display.php");
            exit();
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulir Data Penerbit & Supplier</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="editor.css">
</head>
<body>

    <div class="form-container">
        <h2>Formulir Tambah Data Penerbit & Supplier</h2>

        <form action="" method="POST">

            <label>Nama Penerbit:</label>
            <input type="text" name="nama_penerbit" value="<?php echo $penerbit; ?>">
            <div class="error"><?php echo $penerbitErr; ?></div>

            <label>Nama Supplier:</label>
            <input type="text" name="nama_supplier" value="<?php echo $supplier; ?>">
            <div class="error"><?php echo $supplierErr; ?></div>

            <label>Kontak Sales:</label>
            <input type="tel" name="kontak_sales" placeholder="08123xxxxxxx" value="<?php echo $kontak; ?>">
            <div class="error"><?php echo $kontakErr; ?></div>

            <label>Alamat:</label>
            <textarea name="alamat" rows="5"><?php echo $alamat; ?></textarea>
            <div class="error"><?php echo $alamatErr; ?></div>

            <button type="submit">Simpan Data</button>

        </form>
    </div>

    <p style="text-align:center;">
        <a href="PenerbitDanSupplier_Display.php">Lihat Semua Data &rarr;</a>
    </p>

</body>
</html>