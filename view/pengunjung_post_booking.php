
<style>
	@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&family=Lato:wght@400;500;600;700;900&display=swap');
	*{
		line-height: 1.8;
		font-family : 'Lato', sans-serif;
		font-weight: 700;
	}
	div{
		text-align: center;
		margin: auto;
	}
	.info{
		background-color: #003B73;
		color: white;
  		width: 700px;
  		padding: 15px;
  		border-radius: 20px;
	}
	.data{
		margin: 50px;
		font-size: 18px;
	}

	.backbutton{
		text-decoration: none;
		background-color: white;
		color: #003B73;
		border-radius: 10px;
		border: 2px solid;
		padding: 8px 20px 8px 20px;
	}
	.thanks{
		font-weight: 300;
	}

</style>

<div><h2>RESERVASI TIKET BERHASIL</h2></div>
<div class="info">Bukti reservasi ini berlaku sebagai syarat pembayaran tiket masuk tempat wisata FUN. <br>Simpan dan tunjukkan tangkapan layar ini ketika akan melakukan pembayaran.</div>

<div class="data">
    <label>Nama : <?php echo $nama ?></label>
    <br>
    <label>Tanggal : <?php echo date("d/m/Y", strtotime($tanggal)) ?></label>
    <br>
    <label>Jumlah Pengunjung : <?php echo $jml ?> orang</label>
    <br>
    <label>Kode Booking : <?php echo $kode ?></label>
</div>

<div>
	<a href="home" class="backbutton"> KEMBALI </a>
</div>
<br>
<div class="thanks">Terimakasih sudah melakukan reservasi, sampai berjumpa di FUN Resort!</div>
