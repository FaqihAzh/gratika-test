CREATE DATABASE IF NOT EXISTS klinik;
USE klinik;

CREATE TABLE faskes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_dokter VARCHAR(100),
    alamat TEXT,
    signature TEXT
);

CREATE TABLE pasien (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_pasien VARCHAR(100),
    alamat TEXT,
    penanggung_jawab VARCHAR(100),
    jenis_kelamin ENUM('L', 'P'),
    umur INT,
    tanggal_lahir DATE,
    signature TEXT
);

CREATE TABLE obat (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_obat VARCHAR(100),
    harga_satuan DECIMAL(10,2)
);

CREATE TABLE transaksi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tanggal DATE,
    id_faskes INT,
    id_pasien INT,
    total_biaya DECIMAL(10,2),
    FOREIGN KEY (id_faskes) REFERENCES faskes(id),
    FOREIGN KEY (id_pasien) REFERENCES pasien(id)
);

CREATE TABLE detail_transaksi (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_transaksi INT,
    id_obat INT,
    qty DECIMAL(5,2),
    subtotal DECIMAL(10,2),
    FOREIGN KEY (id_transaksi) REFERENCES transaksi(id),
    FOREIGN KEY (id_obat) REFERENCES obat(id)
);

INSERT INTO faskes (nama_dokter, alamat, signature)
VALUES ('Dr. Demo Version', 'J. Jambu No 21 Depok', 'Signature_Dokter');

INSERT INTO pasien (nama_pasien, alamat, penanggung_jawab, jenis_kelamin, umur, tanggal_lahir, signature)
VALUES ('BRONTO', 'JL. KAMBOJA NO. 5', NULL, 'L', 34, '1989-11-06', 'Signature_Pasien');

INSERT INTO obat (nama_obat, harga_satuan)
VALUES 
('PEMERIKSAAN', 10000),
('AMOXICILLIN 500MG', 400),
('PARACETAMOL 500MG', 250);

INSERT INTO transaksi (tanggal, id_faskes, id_pasien, total_biaya)
VALUES ('2003-11-06', 1, 1, 19750);

INSERT INTO detail_transaksi (id_transaksi, id_obat, qty, subtotal)
VALUES 
(1, 1, 1, 10000),
(1, 2, 15, 6000),
(1, 3, 15, 3750);

-- a.	Tampilkan data pelanggan yang mempunya kelamin perempuan, umur antara 19 sampai 30, dan pemeriksaan pada bulan Agustus 2015.
SELECT DISTINCT p.id, p.nama_pasien, p.jenis_kelamin, p.umur, t.tanggal
FROM pasien p
JOIN transaksi t ON p.id = t.id_pasien
WHERE p.jenis_kelamin = 'P'
AND p.umur BETWEEN 19 AND 30
AND t.tanggal BETWEEN '2015-08-01' AND '2015-08-31';

-- b.	Tampilkan data semua dokter yang mempunyai transaksi dengan pasien ataupun tidak selama setahun di 2015
SELECT f.id, f.nama_dokter, f.alamat
FROM faskes f
LEFT JOIN transaksi t ON f.id = t.id_faskes AND YEAR(t.tanggal) = 2015;

-- c.	Hitung jumlah obat dan total uang per-obat selama bulan Agustus sampai Desember 2015
SELECT 
    o.nama_obat, 
    SUM(d.qty) AS total_jumlah_obat, 
    SUM(d.subtotal) AS total_pendapatan
FROM detail_transaksi d
JOIN transaksi t ON d.id_transaksi = t.id
JOIN obat o ON d.id_obat = o.id
WHERE t.tanggal BETWEEN '2015-08-01' AND '2015-12-31'
GROUP BY o.nama_obat;

-- d.	Tampilkan 10 Jenis obat apa saja yang paling banyak digunakan selama tahun 2015
SELECT 
    o.nama_obat, 
    SUM(d.qty) AS total_jumlah_obat
FROM detail_transaksi d
JOIN transaksi t ON d.id_transaksi = t.id
JOIN obat o ON d.id_obat = o.id
WHERE YEAR(t.tanggal) = 2015
GROUP BY o.nama_obat
ORDER BY total_jumlah_obat DESC
LIMIT 10;

-- e.	Tampilkan data pelanggan Jika berumur di bawah 18 tahun “Anak-anak”, jika berumur 18 tahun sampai 30 “Dewasa”, dan jika lebih dari 30 “Orang tua”.
SELECT 
    p.id, 
    p.nama_pasien, 
    p.umur, 
    CASE 
        WHEN p.umur < 18 THEN 'Anak-anak'
        WHEN p.umur BETWEEN 18 AND 30 THEN 'Dewasa'
        ELSE 'Orang tua'
    END AS kategori_umur
FROM pasien p; 
