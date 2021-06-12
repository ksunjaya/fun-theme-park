/*Pengunjung (KTP, nama, nomor_hp)
Karyawan  (KTP, nama, username, password)
Pemilik  (KTP, nama, username, password)
Reservasi (id_reservasi, jml_orang, KTP → FK ke Pengunjung, tanggal → FK ke Limit_Tiket)
Limit_Tiket (tanggal, limit_harian, max_pesanan, sisa_tiket)
Transaksi (id_transaksi, id_reservasi → FK ke Reservasi, tanggal → FK ke Harga_Tiket, total_harga)
Harga_Tiket (tanggal, harga)*/

DROP DATABASE fun_resort;
CREATE DATABASE fun_resort;
USE fun_resort;

CREATE TABLE Pengunjung(
  ktp VARCHAR(16) PRIMARY KEY,
  nama VARCHAR(50) NOT NULL,
  nomor_hp VARCHAR(50) NOT NULL
);

CREATE TABLE Karyawan 
(
  ktp varchar(16) PRIMARY KEY, 
  nama varchar(50) NOT NULL, 
  username varchar(25) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Pemilik (
  ktp varchar(16) PRIMARY KEY,
  nama varchar(50) NOT NULL,
  username varchar(25) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Limit_Tiket(
  tanggal DATE PRIMARY KEY,
  limit_harian INT NOT NULL,
  max_pesanan INT NOT NULL,
  sisa_tiket INT NOT NULL
);

CREATE TABLE Reservasi(
	id_reservasi INT(8) AUTO_INCREMENT PRIMARY KEY,
	jml_orang INT(2) NOT NULL,
	ktp varchar(16) NOT NULL,
	tanggal DATE NOT NULL,
  FOREIGN KEY (ktp) REFERENCES Pengunjung(ktp),
  FOREIGN KEY (tanggal) REFERENCES Limit_Tiket(tanggal)
);

CREATE TABLE Harga_Tiket(
  tanggal DATE PRIMARY KEY,
  harga INT NOT NULL
);

CREATE TABLE Transaksi(
  id_transaksi INT(8) AUTO_INCREMENT PRIMARY KEY,
  id_reservasi INT(8) NOT NULL,
  tanggal DATE NOT NULL,
  total_harga INT NOT NULL,
  FOREIGN KEY (id_reservasi) REFERENCES Reservasi(id_Reservasi),
  FOREIGN KEY (tanggal) REFERENCES Harga_Tiket(tanggal)
);
