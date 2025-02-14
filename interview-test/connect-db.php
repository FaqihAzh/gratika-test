<?php
$host = "localhost";  
$user = "root";
$pass = "";  
$db   = "dbName"; 

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$sql = "SELECT * FROM pelanggan";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Daftar Pelanggan</h2>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>".$row["id_pelanggan"]."</td>
                <td>".$row["nama"]."</td>
                <td>".$row["alamat"]."</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data pelanggan.";
}

$conn->close();
?>
