<?php
require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $statusBaru = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "UPDATE penerbit_supplier SET status = '$statusBaru' WHERE id = '$id'";
    mysqli_query($conn, $sql);

    header("Location: PenerbitDanSupplier_Display.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM penerbit_supplier ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Penerbit & Supplier</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="editor.css">
</head>
<body>

    <div class="table-container">
        <h2>Data Penerbit & Supplier</h2>

        <table>
            <tr>
                <th>No</th>
                <th>Nama Penerbit</th>
                <th>Nama Supplier</th>
                <th>Kontak Sales</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            <?php
            if (mysqli_num_rows($result) == 0) {
                echo "<tr><td colspan='7' style='text-align:center;'>Belum ada data</td></tr>";
            } else {
                $no = 1;
                while ($data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . htmlspecialchars($data['nama_penerbit']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['nama_supplier']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['kontak_sales']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['alamat']) . "</td>";

                    echo "<td>";
                    echo "<form action='' method='POST' class='status-form'>";
                    echo "<input type='hidden' name='id' value='" . $data['id'] . "'>";
                    echo "<input type='hidden' name='update_status' value='1'>";
                    $selectedDiproses = ($data['status'] == "Diproses") ? "selected" : "";
                    $selectedBerhasil = ($data['status'] == "Berhasil") ? "selected" : "";
                    $statusClass = ($data['status'] == "Berhasil") ? "status-berhasil" : "status-diproses";
                    echo "<select name='status' class='status-select " . $statusClass . "' onchange='this.form.submit()'>";
                    echo "<option value='Diproses' $selectedDiproses>Diproses</option>";
                    echo "<option value='Berhasil' $selectedBerhasil>Berhasil</option>";
                    echo "</select>";
                    echo "</form>";
                    echo "</td>";

                    echo "<td class='aksi'>";
                    echo "<a href='PenerbitDanSupplier_Edit.php?id=" . $data['id'] . "'>Edit</a> | ";
                    echo "<a href='PenerbitDanSupplier_Delete.php?id=" . $data['id'] . "' onclick=\"return confirm('Yakin mau hapus data ini?')\">Hapus</a>";
                    echo "</td>";

                    echo "</tr>";
                    $no++;
                }
            }
            ?>
        </table>

        <a href="PenerbitDanSupplier_Index.php" class="tambah-btn">+ Tambah Data Baru</a>
    </div>

</body>
</html>