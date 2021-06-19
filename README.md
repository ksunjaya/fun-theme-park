# Fun Resort

Website untuk memenuhi tugas akhir MIBD dan PBW dengan topik 1 : registrasi tempat wisata.

## Requirements
Jika elemen pada website bertabrakan, disarankan menggunakan monitor FHD (1920x1080) dan scaling pada display windows di-set ke 100% (atau  dapat menggunakan fitur zoom out pada browser)

## Installation

Silahkan menjalankan dua buah file query pada console database mySQL Anda.

```query
source \path\to\fun_resort\queries\ddl.sql
source \path\to\fun_resort\queries\data.sql
```

## Usage

Sebagai pengunjung, silahkan langsung mengakses baseURL nya pada browser Anda.
Sebagai contoh jika baseURL = "localhost\fun_resort"

```web
localhost\fun_resort
```

Sebagai sisi admin maupun karyawan, silahkan mengakses page login terlebih dahulu. Jika memasukkan credentials sebagai admin, maka halaman admin akan langsung muncul setelah login. Jika memasukkan credentials sebagai karyawan, maka halaman karyawan yang akan muncul.

```web
localhost\fun_resort\login
```

Berikut dummy credentials admin dan karyawan yang dapat digunakan

```text
===Admin===
Username : user_willy
Password : thewilwon123

===Karyawan===
Username : bangdodo
Password : dordor2021
```

## Contributors
- Sharon Kezia F, 6181901006
- Kevin Sunjaya, 6181901008
- Vincent Kurniawan, 6181901024

## Licenses
Gambar-gambar pada folder src diambil dari Google.