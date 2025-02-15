<?php
class Transaction {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getLatestTransaction() {
        $sql = "SELECT t.id, t.tanggal, f.nama_dokter, f.alamat AS alamat_dokter, 
                       p.nama_pasien, p.alamat AS alamat_pasien, p.penanggung_jawab, 
                       p.jenis_kelamin, p.umur, p.tanggal_lahir, t.total_biaya
                FROM transaksi t
                JOIN faskes f ON t.id_faskes = f.id
                JOIN pasien p ON t.id_pasien = p.id
                ORDER BY t.id DESC LIMIT 1";
        
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function getTransactionDetails($transactionId) {
        $sql = "SELECT o.nama_obat, o.harga_satuan, d.qty, d.subtotal 
                FROM detail_transaksi d
                JOIN obat o ON d.id_obat = o.id
                WHERE d.id_transaksi = ?";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $transactionId);
        $stmt->execute();
        return $stmt->get_result();
    }
}