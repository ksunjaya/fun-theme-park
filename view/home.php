<?php
  $today = new DateTime(date("Y-m-d"));
  $today->modify('+1 day');
  $today = $today->format("Y-m-d");
  $next_month = new DateTime($today);
  $next_month->modify('+30 days');
  $next_month = $next_month->format("Y-m-d");
?>
<div class="parent-flex">
  <div class="left-container">
    <h3 class="blue" id="title">Watch Dreams Come True at the Happiest Place on Earth</h3>
    
    <a id="about" class="cairo" href="about">PELAJARI LEBIH LANJUT</a>
  </div>
  <div class="right-container">
    <div class="reservasi">
      <h1 class="blue cairo">RESERVASI TIKET</h1>
      <form class="cairo form" action="confirmation" method="POST">
        <label>NOMOR KTP</label><br>
        <input name="ktp" id="ktp" type="text"><br>

        <label>NAMA LENGKAP</label><br>
        <input name="nama" id="nama" type="text"><br>

        <label>NOMOR TELEPON</label><br>
        <input name="telepon" id="telepon" type="text"><br>
        
        <table>
          <tr>
            <td style="width: 60%; padding: 0px;">
              <label>TANGGAL KUNJUGAN</label><br>
              <?php
                echo '<input name="tanggal" id="tanggal" type="date" min="'.$today.'" max="'.$next_month.'"><br>';
              ?>
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
            <td style="width: 20%; padding: 0px;">
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

<script>
  function init(){
    let tombol_submit = document.getElementById("tombol-submit");
    tombol_submit.addEventListener("click", onClick);

    let tanggal = document.getElementById("tanggal");
    tanggal.addEventListener("change", onDateChange)
  }

  function onDateChange(e){
    let kuota = document.getElementById("kuota");
    let select_jumlah = document.getElementById("jumlah-pengunjung");
    clear_jumlah_pengunjung(select_jumlah); //kosongkan dulu options jumlah orangnya karena setiap hari bisa beda beda jumlah max nya

    fetch('getkuota?tanggal='+tanggal.value)
      .then(function(response){
        return response.text();
      }).then(function(result){
        if(result != ""){
          let arr_kuota_limit = JSON.parse(result);
          kuota.innerHTML = arr_kuota_limit["sisa_tiket"];
          kuota.style.color = "black";
          
          //tambahin angka dari 1 - max jumlah
          let max_pengunjung = Math.min(arr_kuota_limit["max_pesanan"], arr_kuota_limit["sisa_tiket"]);
          for(i = 1; i <= max_pengunjung; i++){
            var opt = document.createElement('option');
            opt.value = i;
            opt.innerHTML = i;
            select_jumlah.appendChild(opt);
          }
        }else{
          kuota.innerHTML = 0;
          kuota.style.color = "red";
        }
    });
  
  }

  function clear_jumlah_pengunjung(elem){
    for(i = elem.options.length - 1; i >= 0; i--) elem.options[i] = null;
  }

  function onClick(e){
    //e.preventDefault();
    
  }

  function showAlert(){

  }

  function validate_ktp(){
    let ktp = document.getElementById("ktp").value;
    if(ktp.length != 16) return false;
    for(let i = 0; i < 16; i++){
      if (ktp.charAt(i) >= '0' && ktp.charAt(i) <= '9') continue;
      else return false;
    }
    return true;
  }

  function validate_telepon(){
    let telepon = document.getElementById("telepon").value;
    for(let i = 0; i < telepon.length; i++){
      if (telepon.charAt(i) >= '0' && telepon.charAt(i) <= '9') continue;
      else return false;
    }
  }

  init();
</script>