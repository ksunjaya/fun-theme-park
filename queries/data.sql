/**
  Disini hanya disediakan limit tiket untuk tanggal 1 Juli - 5 Juli
  Untuk menambah data lagi, silahkan mengakses halaman admin.
**/
INSERT INTO Harga_Tiket
VALUES ('2021-07-01', 40000);

INSERT INTO Harga_Tiket
VALUES ('2021-07-02', 40000);

INSERT INTO Harga_Tiket
VALUES ('2021-07-03', 60000);

INSERT INTO Harga_Tiket
VALUES ('2021-07-04', 60000);

INSERT INTO Harga_Tiket
VALUES ('2021-07-05', 60000);



INSERT INTO Limit_Tiket
VALUES ('2021-07-01', 400, 5, 211);

INSERT INTO Limit_Tiket
VALUES ('2021-07-02', 400, 5, 213);

INSERT INTO Limit_Tiket
VALUES ('2021-07-03', 500, 6, 122);

INSERT INTO Limit_Tiket
VALUES ('2021-07-04', 500, 6, 98);

INSERT INTO Limit_Tiket
VALUES ('2021-07-05', 500, 6, 80);



INSERT INTO Pemilik 
VALUES ('1384281900120541', 'Willy Wonka', 'user_willy', 'thewilwon123');


/**INSERT INTO Karyawan
VALUES ('1384281923761014', 'Wombat Wonderland', 'woland', 'wombwonder01', NULL);**/

INSERT INTO Karyawan
VALUES ('1384281923761034', 'Dodo Digidigi Bang', 'bangdodo', 'dordor2021', 'uploads/bangdodo/foto.jpg');

/**INSERT INTO Karyawan
VALUES ('1384281923761001', 'Bambang Budiman', 'Bambankxs', 'bambu1020', NULL);**/


UPDATE Pemilik SET pemilik.password = PASSWORD(password);
UPDATE Karyawan SET karyawan.password = PASSWORD(password);
