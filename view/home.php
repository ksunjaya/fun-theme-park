<div class="parent-flex">
  <div class="left-container">
    <h1 class="blue" id="title">Watch Dreams Come <br>True at the Happiest <br>Place on Earth</h1>
    
    <a id="about" class="cairo" href="about">PELAJARI LEBIH LANJUT</a>
  </div>
  <div class="right-container">
    <div class="reservasi">
      <h1 class="blue cairo">RESERVASI TIKET</h1>
      <form class="cairo form" method="POST">
        <label>NOMOR KTP</label><br>
        <input name="ktp" type="text"><br>

        <label>NAMA LENGKAP</label><br>
        <input name="nama" type="text"><br>

        <label>NOMOR TELEPON</label><br>
        <input name="telepon" type="text"><br>
        
        <table>
          <tr>
            <td style="width: 60%;">
              <label>TANGGAL KUNJUGAN</label><br>
              <input name="tanggal" id="tanggal" type="date"><br>
            </td>
            <td style="width: 13%;"></td>
            <td style="font-family: 'Cairo', sans-serif;">
              <p style="margin: 9px 0px 0px 0px;">SISA KUOTA</p>
              <p id="kuota" style="font-weight:700; margin: 0px; ">-</p>
            </td>
          </tr>      
        </table>
        
        <table>
          <tr>
            <td style="width: 20%;">
              <p style="text-align: center; margin: 0px; line-height: 130%;">JUMLAH PENGUNJUNG</p>
              <select id="jumlah-pengunjung">

              </select>
            </td>
            <td style="width: 10%"></td>
            <td style="width: 30%">
              <p style="margin: 9px 0px 0px 0px;">PRICE</p>
              <p id="price" style="font-weight:700; margin: 0px; ">-</p>
            </td>
            <td style="width: 10%"></td>
            <td style="width: 30%">
              <p style="margin: 9px 0px 0px 0px;">TOTAL</p>
              <p id="total-price" style="font-weight:700; margin: 0px; ">-</p>
            </td>
          </tr>
        </table>

        <p style="font-size: 15px;">*Reservasi hanya bisa dilakukan untuk 30 hari kedepan</p>
        <input type="submit" id="tombol-submit" value="RESERVASI">
      </form>
    </div>
  </div>
</div>