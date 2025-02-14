<?php
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_pasien'];
    $alamat = $_POST['alamat'];
    $penanggung_jawab = $_POST['penanggung_jawab'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $umur = $_POST['umur'];

    $query = "INSERT INTO pasien (nama_pasien, alamat, penanggung_jawab, jenis_kelamin, umur) 
              VALUES ('$nama', '$alamat', '$penanggung_jawab', '$jenis_kelamin', '$umur')";
    mysqli_query($conn, $query);
    header("Location: pasien.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pasien</title>
</head>
<body>
    <h2>Tambah Pasien</h2>
    <form method="POST">
        Nama: <input type="text" name="nama_pasien" required><br>
        Alamat: <input type="text" name="alamat" required><br>
        Penanggung Jawab: <input type="text" name="penanggung_jawab" required><br>
        Jenis Kelamin: 
        <select name="jenis_kelamin">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select><br>
        Umur: <input type="number" name="umur" required><br>
        <input type="submit" value="Simpan">
    </form>

    <h2>Daftar Pasien</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Penanggung Jawab</th>
            <th>Jenis Kelamin</th>
            <th>Umur</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM pasien");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nama_pasien']}</td>
                    <td>{$row['alamat']}</td>
                    <td>{$row['penanggung_jawab']}</td>
                    <td>{$row['jenis_kelamin']}</td>
                    <td>{$row['umur']}</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
