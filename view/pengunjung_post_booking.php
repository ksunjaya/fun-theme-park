<div class="div2"><h1>RESERVASI TIKET BERHASIL</h1></div>
<br>
<div class="info div2">Bukti reservasi ini berlaku sebagai syarat pembayaran tiket masuk tempat wisata FUN. <br>Simpan dan tunjukkan tangkapan layar ini ketika akan melakukan pembayaran.</div>

<div class="data div2">
    <label>Nama : <?php echo $nama ?></label>
    <br>
    <label>Tanggal : <?php echo date("d M Y", strtotime($tanggal)) ?></label>
    <br>
    <label>Jumlah Pengunjung : <?php echo $jml ?> orang</label>
    <br>
    <label>Kode Booking : <?php echo $kode ?></label>
</div>

<div class="div2">
	<a href="home" class="blue_button"> KEMBALI </a>
</div>
<br>
<div class="div2" style="font-weight: 300;">Terimakasih sudah melakukan reservasi, sampai berjumpa di FUN Resort!</div>
