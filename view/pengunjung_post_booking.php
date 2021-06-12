
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
		background-color: white;
		color: #003B73;
		border-radius: 10px;
		border: 2px solid;
		padding: 5px 15px 5px 15px;
	}
	.thanks{
		font-weight: 300;
	}

</style>

<div><h2>RESERVASI TIKET BERHASIL</h2></div>
<div class="info">Bukti reservasi ini berlaku sebagai syarat pembayaran tiket masuk tempat wisata FUN. <br>Simpan dan tunjukkan tangkapan layar ini ketika akan melakukan pembayaran.</div>

<div class="data">
    <label>Nama : <?php $nama ?></label>
    <br>
    <label>Tanggal : <?php $tgl ?></label>
    <br>
    <label>Jumlah Pengunjung : <?php $jml ?> orang</label>
    <br>
    <label>Kode Booking : <?php $kode ?></label>
</div>

<div><input type="submit" name="kembali" value="KEMBALI" class="backbutton"></div>
<br>
<div class="thanks">Terimakasih sudah melakukan reservasi, sampai berjumpa di FUN Resort!</div>
