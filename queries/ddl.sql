/*
  22 JUNI!
  PENTING! Tolong jalanin query ini buat modify table nya : 

  ALTER TABLE karyawan ADD UNIQUE(username);
  ALTER TABLE karyawan ADD photo_location varchar(100);
*/

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
  password varchar(50) NOT NULL,
  photo_location varchar(100),
  UNIQUE(username)
);

CREATE TABLE Pemilik (
  ktp varchar(16) PRIMARY KEY,
  nama varchar(50) NOT NULL,
  username varchar(25) NOT NULL,
  password varchar(50) NOT NULL,
  UNIQUE(username)
);

CREATE TABLE Limit_Tiket(
  tanggal DATE PRIMARY KEY,
  limit_harian INT NOT NULL,
  max_pesanan INT NOT NULL,
  sisa_tiket INT NOT NULL
);

CREATE TABLE Reservasi(
	id_reservasi INT(10) PRIMARY KEY,
	jml_orang INT(2) NOT NULL,
	ktp varchar(16) NOT NULL,
	tanggal DATE NOT NULL,
  selesai INT(1) NOT NULL,
  FOREIGN KEY (ktp) REFERENCES Pengunjung(ktp),
  FOREIGN KEY (tanggal) REFERENCES Limit_Tiket(tanggal)
);

CREATE TABLE Harga_Tiket(
  tanggal DATE PRIMARY KEY,
  harga INT NOT NULL
);

CREATE TABLE Transaksi(
  id_transaksi VARCHAR(12) PRIMARY KEY,
  id_reservasi INT(10) NOT NULL,
  tanggal DATE NOT NULL,
  total_harga INT NOT NULL,
  FOREIGN KEY (id_reservasi) REFERENCES Reservasi(id_Reservasi),
  FOREIGN KEY (tanggal) REFERENCES Harga_Tiket(tanggal)
);
