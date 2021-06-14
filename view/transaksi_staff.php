<?php
  $today = new DateTime(date("d M Y"));
  $today = $today->format("d M Y");
?>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&family=Lato:wght@400;500;600;700;900&display=swap');
  *{
    font-family: 'Cairo', sans-serif;
    line-height: 100%;
  } 
  
  body{
    background-color: #DBE9FF;
  }

  .blue-button{
    background-color: #003B73;
    border:2px solid #003B73;
    color: white;
    font-weight: 900;
    text-decoration: none;
    padding: 8px 30px;
    border-radius: 15px;
    transition: 0.1s; 
  }

  .float-right{
    float:right;
  }
  
  .bold{
    font-weight: 700;
  }

  .welcome{
    margin: 16px;
    font-size: 28px;
  }

  .white-box{
    background-color: white;
    margin: 3%;
    border-radius: 20px;
  }

  .bg-white{
    background-color: white;
  }

  label{
    font-size: 20px;
  }

  .text-input{
    background-color: #DBE9FF;
    border: 0px;
    margin: 5px 0px;
    border-radius: 5px;
    font-size: 20px;
  }

  .search{
    margin: 5px 0px;
    background-color: #003B73;
    border-radius: 5px;
  }
</style>

<div id="header" style="display:flex; align-items: center; margin: 18px 50px;">
  <div style="flex: 1;">
    <a href="../home"><img src="../src/logo.png" style="width:140px;"></a>
  </div>
  <div style="flex:6; text-align: center;">
    <p class="welcome">Welcome</p>
    <p class="welcome bold">Willy Wonka</p>
  </div>
  <div style="flex:1;">
    <a class="blue-button float-right" href="signout">SIGN OUT</a>
  </div>
</div>

<div id="info" style="display:flex; margin: 0px 50px;">
  <div style="flex:1;">
    <p style="font-size: 20px; margin: 5px;">Tanggal Hari Ini</p>
    <p class="bold" style="font-size: 30px; margin: 5px;"><?php echo $today ?></p>
  </div>
  <div style="flex:6; text-align: center;">

  </div>
  <div style="flex:1;">
    <p class="float-right" style="font-size: 20px; margin: 5px;">Harga/Tiket</p>
    <p class="float-right bold" style="font-size: 30px; margin: 5px;">Rp. 10.000</p>
  </div>
</div>

<div id="interface" style="display:flex; margin: 0px 50px;">
  <div class="white-box" id="input-container" style="flex: 5; height: 100%">
  <div class="white-box">
  <form class="bg-white" method="POST">
    <label class="bg-white">Kode Reservasi</label>
    <br>
    <input id="kode-reservasi" name="kode" type="input" maxlength="10" class="text-input" style="width:85%; height: 20%; text-align:center;">
    <a href="cari-reservasi" id="cari" class="blue-button float-right" style="margin: 1% 0px;">Cari</a>
    <p id="status" class="bold" style="margin:8px 0px; font-size:20px;">Kode Reservasi Berhasil Ditemukan!</p>

    <div style="display: flex; justify-content:center; margin: 20px 0px;">
      <table style="align-self:center; font-size: 20px;">
        <tr>
          <td>Nama Pemesan</td>
          <td style="padding: 0em 2em;"></td>
          <td><input type="text" class="text-input" name="nama" id="nama" disabled></td>
        </tr>
        <tr>
          <td>Jumlah Tiket</td>
          <td style="padding: 0em 2em;"></td>
          <td><input type="number" class="text-input" name="jumlah" id="jumlah" style="width: 20%;text-align:center;"><label style="margin-left: 12px;">tiket</label></td>
        </tr>
        <tr>
          <td>Total Harga</td>
          <td style="padding: 0em 2em;"></td>
          <td><input type="text" class="text-input" name="harga" id="harga" disabled></td>
        </tr>
      </table>
    </div>

    <input type="submit" class="blue-button" id="btn-submit" value="Cetak" style="margin: 0% 40% 0% 40%;">
  </form>
  </div>
  </div>
  <div id="nomor-tiket-container" style="flex: 4;"></div>
</div>

<script>
  function init(){
    let tombol_cari = document.getElementById("cari");
    tombol_cari.addEventListener("click", get_registrasi);
  }

  function get_registrasi(e){
    e.preventDefault(); //biar ga redirect
  }
  init();
</script>