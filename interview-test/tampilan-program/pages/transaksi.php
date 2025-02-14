<?php
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal = $_POST['tanggal'];
    $id_faskes = $_POST['id_faskes'];
    $id_pasien = $_POST['id_pasien'];
    $total_biaya = $_POST['total_biaya'];

    $query = "INSERT INTO transaksi (tanggal, id_faskes, id_pasien, total_biaya) 
              VALUES ('$tanggal', '$id_faskes', '$id_pasien', '$total_biaya')";
    mysqli_query($conn, $query);
    header("Location: transaksi.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
</head>
<body>
    <h2>Tambah Transaksi</h2>
    <form method="POST">
        Tanggal: <input type="date" name="tanggal" required><br>
        Dokter: <input type="number" name="id_faskes" required><br>
        Pasien: <input type="number" name="id_pasien" required><br>
        Total Biaya: <input type="number" name="total_biaya" required><br>
        <input type="submit" value="Simpan">
    </form>
</body>
</html>
