<link rel="stylesheet" href="style_pengunjung.css">
<link rel="stylesheet" href="style_home.css">
<style>

	@import url('https://fonts.googleapis.com/css2?family=Lato:wght@700;900&display=swap');
	*{
		line-height: 1.8;
	}
	div{
		text-align: center;
		margin: auto;
	}
	.info{
		background-color: #003B73;
		color: white;
  		width: 600px;
  		padding: 15px;
  		border-radius: 20px;
	}
	.data{
		margin: 50px;
	}

	.customButton{
		background-color: white;
		color: #003B73;
		border-radius: 10px;
		border: 2px solid;
		padding: 5px 15px 5px 15px;
	}

</style>

<div><h2>RESERVASI TIKET BERHASIL</h2></div>
<div class="info">Bukti reservasi ini berlaku sebagai syarat pembayaran tiket masuk tempat wisata FUN. <br>Simpan dan tunjukkan tangkapan layar ini ketika akan melakukan pembayaran.</div>

<div class="data">
    <label>Nama : <?php  ?></label>
    <br>
    <label>Tanggal : <?php  ?></label>
    <br>
    <label>Jumlah Pengunjung : <?php  ?> orang</label>
    <br>
    <label>Kode Booking : <?php  ?></label>
</div>

<div><input type="submit" name="kembali" value="KEMBALI" class="customButton"></div>
<br>
<div>Terimakasih sudah melakukan reservasi, sampai berjumpa di FUN Resort!</div>
