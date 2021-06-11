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
  nama varchar(50), 
  username varchar(25),
  password varchar(50)
);

CREATE TABLE Pemilik (
  ktp varchar(16) PRIMARY KEY,
  nama varchar(50),
  username varchar(25),
  password varchar(50)
);

CREATE TABLE Reservasi(
	id_reservasi INT(8) AUTO_INCREMENT PRIMARY KEY,
	jml_orang INT(2) NOT NULL,
	nama VARCHAR(50) NOT NULL,
	tanggal DATE NOT NULL
);

CREATE TABLE Limit_Tiket(
  tanggal DATE PRIMARY KEY,
  limit_harian INT NOT NULL,
  max_pesanan INT NOT NULL,
  sisa_tiket INT NOT NULL
);

CREATE TABLE Transaksi(
  id_transaksi INT(8) AUTO_INCREMENT PRIMARY KEY,
  id_reservasi INT(8) NOT NULL,
  tanggal DATE NOT NULL,
  total_harga INT NOT NULL
);

CREATE TABLE Harga_Tiket(
  tanggal DATE PRIMARY KEY,
  harga INT NOT NULL
);