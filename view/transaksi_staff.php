<?php
  $raw_today = new DateTime(date("ymd"));
  $today = $raw_today->format("d M Y");

  require_once "controller/hargaTiketController.php";
  $tiket_ctrl = new HargaTiketController();
  $harga = $tiket_ctrl->get_harga($raw_today->format("ymd"));

  function format_harga($harga){
    $result = "";
    for($i = strlen($harga)-3; $i >= 0; $i -= 3){
      $result = substr($harga, 0, $i).'.'.substr($harga, $i, strlen($harga));
    }
    return $result;
  }
?>

<div id="header" style="display:flex; align-items: center; margin: 18px 50px;">
  <div style="flex: 1;">
    <a href="home"><img src="src/logo.png" style="width:140px;"></a>
  </div>
  <div style="flex:6; text-align: center;">
    <p class="welcome">Welcome</p>
    <p class="welcome bold"><?php echo $_SESSION["name"]; ?></p>
  </div>
  <div style="flex:1;">
    <a class="blue-button float-right" href="logout">SIGN OUT</a>
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
    <p class="float-right bold" style="font-size: 30px; margin: 5px;"><?php echo 'Rp. '.format_harga($harga) ?></p>
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
    <p id="status" class="bold" style="margin:8px 0px; font-size:20px;visibility:hidden;"></p>

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
          <td><input type="number" class="text-input" name="jumlah" id="jumlah" style="width: 20%;text-align:center;" min=1><label style="margin-left: 12px;">tiket</label></td>
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

    let jumlah_text = document.getElementById("jumlah");
    jumlah_text.addEventListener("input", function(e){
      let total_harga_text = document.getElementById("harga");
      total_harga_text.value = (<?php echo $harga ?> * jumlah_text.value).toLocaleString('en-US', {style: 'currency',currency: 'IDR'});
    });

    let kode_reservasi = document.getElementById("kode-reservasi");
    kode_reservasi.addEventListener("keyup", function(event) {
      if(kode_reservasi.value.length >= 6){
        tombol_cari.click();
      }else{
        let status_text = document.getElementById("status");
        clear_all();
        status_text.style.visibility = "hidden";
      }
    });

    let btn_submit = document.getElementById("btn-submit");
    btn_submit.addEventListener("click", form_submit);
  }

  function get_registrasi(e){
    e.preventDefault(); //biar ga redirect

    let status_text = document.getElementById("status");
    let nama_text = document.getElementById("nama");
    let jumlah_text = document.getElementById("jumlah");
    let total_harga_text = document.getElementById("harga");
    let id = document.getElementById("kode-reservasi").value;

    //cek dulu tanggal di kode reservasi nya uda bener ato belom
    let hari_ini = <?php echo $raw_today->format("ymd"); ?>;
    if(id.substr(0, 6) != hari_ini){
      not_found("Tanggal pada kode reservasi salah!", "#ff6700");
      return;
    }
    //klo uda bener, baru lanjut cek di database
    const loadRegistrasi = async() => {
      let url = 'get-reservasi?id='+id+'&tanggal='+<?php echo $raw_today->format("Ymd") ?>;
      let res = await fetch(url);
      let data_registrasi = await res.json();

      if(data_registrasi["status"] == true){
        if(data_registrasi["selesai"] == 0){
          status_text.style.color = "#34832D";
          status_text.innerHTML = "Data pemesan berhasil ditemukan!";
          //====isi"in semua form nya====
          nama_text.value = data_registrasi["nama"];
          jumlah_text.value = data_registrasi["jumlah"];
          jumlah_text.max = data_registrasi["jumlah"];
          total_harga_text.value = (<?php echo $harga ?> * data_registrasi["jumlah"]).toLocaleString('en-US', {style: 'currency',currency: 'IDR'});
        }else{
          //artinya kode registrasi ini udah pernah diregister sebelumnya.
          not_found("Pembeli sudah menyelesaikan transaksinya.", "#ff6700");
        }
      }else{
        not_found("Data pemesan untuk hari ini gagal ditemukan, pastikan kode reservasi sudah benar!", "red");
      }
    };
    loadRegistrasi();

    status_text.style.visibility = "visible";
  }

  function form_submit(e){
    e.preventDefault();
    
  }

  function not_found(message, color){
    let status_text = document.getElementById("status");
    status_text.style.color = color;
    status_text.innerHTML = message;
    status_text.style.visibility = "visible";
    clear_all();
  }

  function clear_all(){
    let nama_text = document.getElementById("nama");
    let jumlah_text = document.getElementById("jumlah");
    let total_harga_text = document.getElementById("harga");
    nama_text.value = "";
    jumlah_text.value = "";
    total_harga_text.value = "";
  }

  init();
</script>