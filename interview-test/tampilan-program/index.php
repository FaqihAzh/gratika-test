<?php
require_once './config/config.php';
require_once './models/Transaction.php';

$transaction = new Transaction($conn);
$transactionData = $transaction->getLatestTransaction();
$transactionDetails = $transaction->getTransactionDetails($transactionData['id']);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Biaya Periksa / Obat / Tindakan</title>
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
    <div class="header">
        <div class="doc-info">
            <h2><?= htmlspecialchars($transactionData['nama_dokter']) ?></h2>
            <hr>
            <p><?= htmlspecialchars($transactionData['alamat_dokter']) ?></p>
        </div>
        <div class="nota-number">
            <h1 class="title">Nota Biaya Periksa / Obat / Tindakan</h1>
            <p>No. <?= htmlspecialchars($transactionData['id']) ?></p>
        </div>
    </div>

    <div class="patient-info">
        <div>
            <p>Pasien : <?= htmlspecialchars($transactionData['nama_pasien']) ?></p>
            <p>Alamat : <?= htmlspecialchars($transactionData['alamat_pasien']) ?></p>
            <p>Penanggung : <?= htmlspecialchars($transactionData['penanggung_jawab'] ?: '-') ?></p>
        </div>
        <div>
            <p>Kelamin : <?= htmlspecialchars($transactionData['jenis_kelamin']) ?></p>
            <p>Umur : <?= htmlspecialchars($transactionData['umur']) ?></p>
            <p>Tanggal : <?= date('d/m/Y', strtotime($transactionData['tanggal'])) ?></p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Keterangan</th>
                <th>Hrg./Tarif Sat.</th>
                <th>Qty</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($row = $transactionDetails->fetch_assoc()):
            ?>
            <tr>
                <td><?= $no++ ?>.</td>
                <td><?= htmlspecialchars($row['nama_obat']) ?></td>
                <td><?= number_format($row['harga_satuan'], 0, ',', '.') ?></td>
                <td><?= htmlspecialchars($row['qty']) ?></td>
                <td><?= number_format($row['subtotal'], 0, ',', '.') ?></td>
            </tr>
            <?php endwhile; ?>
            
            <?php for($i = $no; $i <= 9; $i++): ?>
            <tr>
                <td><?= $i ?>.</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php endfor; ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="hide-col" colspan="4"></td>
                <td class="total">
                    <span>Total</span>
                    <span><?= number_format($transactionData['total_biaya'], 0, ',', '.') ?></span>
                </td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <div class="signature-box">
            Pasien<br><br><br>
            <hr>
        </div>
        <div class="signature-box">
            Dokter<br><br><br>
            <hr>
        </div>
    </div>
</body>
</html>