<?php
include './config/config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Transaksi</title>
</head>
<body>
    <h2>Daftar Transaksi</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Dokter</th>
            <th>Pasien</th>
            <th>Total Biaya</th>
        </tr>
        <?php
        $query = "SELECT t.id, t.tanggal, f.nama_dokter, p.nama_pasien, t.total_biaya 
                  FROM transaksi t 
                  JOIN faskes f ON t.id_faskes = f.id 
                  JOIN pasien p ON t.id_pasien = p.id";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['tanggal']}</td>
                    <td>{$row['nama_dokter']}</td>
                    <td>{$row['nama_pasien']}</td>
                    <td>{$row['total_biaya']}</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
