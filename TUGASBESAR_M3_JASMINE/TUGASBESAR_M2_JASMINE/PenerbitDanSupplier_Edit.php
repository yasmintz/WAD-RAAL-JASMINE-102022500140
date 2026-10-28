<?php
require "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: PenerbitDanSupplier_Display.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM penerbit_supplier WHERE id = '$id'");

if (mysqli_num_rows($result) == 0) {
    header("Location: PenerbitDanSupplier_Display.php");
    exit();
}

$data = mysqli_fetch_assoc($result);

$penerbit = $data['nama_penerbit'];
$supplier = $data['nama_supplier'];
$kontak = $data['kontak_sales'];
$alamat = $data['alamat'];
$status = $data['status'];

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

    $status = $_POST["status"];

    if (empty($penerbitErr) && empty($supplierErr) && empty($kontakErr) && empty($alamatErr)) {

        $penerbitSafe = mysqli_real_escape_string($conn, $penerbit);
        $supplierSafe = mysqli_real_escape_string($conn, $supplier);
        $kontakSafe   = mysqli_real_escape_string($conn, $kontak);
        $alamatSafe   = mysqli_real_escape_string($conn, $alamat);
        $statusSafe   = mysqli_real_escape_string($conn, $status);

        $sql = "UPDATE penerbit_supplier SET
                nama_penerbit = '$penerbitSafe',
                nama_supplier = '$supplierSafe',
                kontak_sales = '$kontakSafe',
                alamat = '$alamatSafe',
                status = '$statusSafe'
                WHERE id = '$id'";

        if (mysqli_query($conn, $sql)) {
            header("Location: PenerbitDanSupplier_Display.php");
            exit();
        } else {
            echo "Gagal update data: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Penerbit & Supplier</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="editor.css">
</head>
<body>

    <div class="form-container">
        <h2>Edit Data Penerbit & Supplier</h2>

        <form action="" method="POST">

            <label>Nama Penerbit:</label>
            <input type="text" name="nama_penerbit" value="<?php echo htmlspecialchars($penerbit); ?>">
            <div class="error"><?php echo $penerbitErr; ?></div>

            <label>Nama Supplier:</label>
            <input type="text" name="nama_supplier" value="<?php echo htmlspecialchars($supplier); ?>">
            <div class="error"><?php echo $supplierErr; ?></div>

            <label>Kontak Sales:</label>
            <input type="tel" name="kontak_sales" value="<?php echo htmlspecialchars($kontak); ?>">
            <div class="error"><?php echo $kontakErr; ?></div>

            <label>Alamat:</label>
            <textarea name="alamat" rows="5"><?php echo htmlspecialchars($alamat); ?></textarea>
            <div class="error"><?php echo $alamatErr; ?></div>

            <label>Status:</label>
            <select name="status">
                <option value="Diproses" <?php if ($status == "Diproses") echo "selected"; ?>>Diproses</option>
                <option value="Berhasil" <?php if ($status == "Berhasil") echo "selected"; ?>>Berhasil</option>
            </select>

            <button type="submit">Update Data</button>

        </form>
    </div>

    <p style="text-align:center;">
        <a href="PenerbitDanSupplier_Display.php">&larr; Kembali ke Data</a>
    </p>

</body>
</html>