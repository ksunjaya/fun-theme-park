<?php
  $today = new DateTime(date("Y-m-d"));
  //$today->modify('+1 day');
  $today = $today->format("Y-m-d");
  $next_month = new DateTime($today);
  $next_month->modify('+30 days');
  $next_month = $next_month->format("Y-m-d");
?>
<div class="parent-flex">
  <div class="left-container">
    <h3 class="blue" id="title">Watch Dream Comes True at the Happiest Place on Earth</h3>
    
    <a id="about" class="cairo" href="about">PELAJARI LEBIH LANJUT</a>
  </div>
  <div class="right-container">
    <div class="reservasi">
      <h1 class="blue cairo" style="margin: 20px 0px;">RESERVASI TIKET</h1>
      <form class="cairo form" action="confirmation" method="POST">
        <label>NOMOR KTP</label><br>
        <input name="ktp" id="ktp" type="text" maxlength="16"><br>

        <label>NAMA LENGKAP</label><br>
        <input name="nama" id="nama" type="text"><br>

        <label>NOMOR TELEPON</label><br>
        <input name="telepon" id="telepon" type="text" maxlength="16"><br>
        
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
              <select id="jumlah-pengunjung" name="jml">

              </select>
            </td>
            <td style="width: 10%"></td>
            <td style="width: 30%">
              <p style="margin: 9px 0px 0px 0px;">HARGA/TIKET</p>
              <p id="harga" style="font-weight:700; margin: 0px; ">-</p>
            </td>
            <td style="width: 10%"></td>
            <td style="width: 30%">
              <p style="margin: 9px 0px 0px 0px;">TOTAL</p>
              <p id="total-harga" style="font-weight:700; margin: 0px; ">-</p>
            </td>
          </tr>
        </table>
        <input type="hidden" name="kuota" id="post-kuota" value="">
        <p style="font-size: 15px; margin: 20px 0px 0px 0px;">*Reservasi hanya bisa dilakukan untuk 30 hari kedepan</p>
        <p style="font-size: 15px; margin: 0px 0px 20px 0px;">**Pastikan nama lengkap sesuai dengan KTP</p>
        
        <span style="text-align:center">
          <span style="display:block;">
            <input type="submit" id="tombol-submit" value="RESERVASI">
          </span>
          <p id="err" style="color:red; visibility:hidden; line-height:130%;">Reservasi tidak dapat diproses. Pastikan semua data sudah terisi dengan benar</p>
          <span style="display:block;"><a id="hilang" href="">Kode reservasi saya hilang</a></span>
        </span>
      </form>
    </div>
  </div>

  <div class="popup cairo" id="popup">
  <div class="popup-content">
    <div class="popup-header">
      <span class="popup-close" id="popup-close">&times;</span>
      <h2>CARI KODE RESERVASI</h2>
    </div>
    <div class="popup-body">
      <form>
        <table style="width: 100%;">
          <tr>
            <td style="width: 55%;"><label>Nomor KTP</label></td>
            <td style="width: 5%;"></td>
            <td><label>Tanggal Kunjungan</label></td>
          </tr>
          <tr>
            <td style="width: 55%;"><input name="ktp" id="hilang-ktp" type="text" maxlength="16"></td>
            <td style="width: 5%;"></td>
            <td><?php echo '<input name="tanggal" id="hilang-tanggal" type="date" min="'.$today.'" max="'.$next_month.'"><br>'; ?></td>
            <td style="width: 5%"></td>
            <td><a id="hilang-cari" href="" class="blue_button" style="height: 32px; width: 100px; margin: 0px; font-weight: 700;">CARI</a></td>
          </tr>
        </table>
      </form>

      <p style="text-align: center; margin: 20px; color:#EE4848; font-weight: 800; visibility: hidden" id="hilang-status">Data tidak ditemukan</p>
      <!--<div id="hilang-result">
        <table style="width: 100%;">
        <td>
          <th>Kode Reservasi</th>
          <th>Jumlah Pengunjung</th>
        </td>
        </table>
      </div>-->
    </div>
  </div>
  </div>
</div>

<script>
  //global attributes
  var harga = 0; //klo harganya 0, artinya user belom memilih tanggal yang valid!

  function init(){
    let tombol_submit = document.getElementById("tombol-submit");
    tombol_submit.addEventListener("click", onClick);

    //event listener buat tanggal kunjungan
    let tanggal = document.getElementById("tanggal");
    tanggal.addEventListener("change", onDateChange);

    //event listener buat jumlah pengunjung, supaya harga total nya bisa terus terupdate
    let jumlah_pengunjung = document.getElementById("jumlah-pengunjung");
    jumlah_pengunjung.addEventListener("change", function(e){
      let harga_total = document.getElementById("total-harga");
      let harga_satuan = document.getElementById("harga");
      harga_total.innerHTML = format_rupiah(parseInt(jumlah_pengunjung.value) * harga);
    });

    //event listener buat semua textbox, supaya kalo uda dimerahin terus usernya input lagi te jadi balik ke biru
    let ktp = document.getElementById("ktp");
    ktp.addEventListener("input", function(e){
      ktp.style.backgroundColor = "#DBE9FF";
      document.getElementById("err").style.visibility = 'hidden';
    });

    let nama = document.getElementById("nama");
    nama.addEventListener("input", function(e){
      nama.style.backgroundColor = "#DBE9FF";
      document.getElementById("err").style.visibility = 'hidden';
    });

    let telepon = document.getElementById("telepon");
    telepon.addEventListener("input", function(e){
      telepon.style.backgroundColor = "#DBE9FF";
      document.getElementById("err").style.visibility = 'hidden';
    });


    //====kode reservasi saya hilang====
    let hilang = document.getElementById("hilang");
    let popup = document.getElementById("popup");
    hilang.addEventListener("click", function(e){
      e.preventDefault();

      popup.style.display = "block";
    });

    let tutup_popup = document.getElementById("popup-close");
    tutup_popup.addEventListener("click", function(e){
      let popup = document.getElementById("popup");
      popup.style.display = "none";
    });

    let hilang_cari = document.getElementById("hilang-cari");
    hilang_cari.addEventListener("click", onCariClick);

    window.onclick = function(event) {
      if (event.target == popup)
        popup.style.display = "none";
    }

  }

  function onCariClick(e){
    e.preventDefault();
    
    let ktp = document.getElementById("hilang-ktp");
    let tanggal = document.getElementById("hilang-tanggal");
    ktp.style.backgroundColor = "#DBE9FF";
    tanggal.style.backgroundColor = "#DBE9FF";
    let status = document.getElementById("hilang-status");
    status.style.visibility = "visible";

    if(validate_ktp(ktp.value) == false){
      ktp.style.backgroundColor="#ffcccb";
      status.style.color = "#EE4848";
      status.innerHTML = "Pastikan data sudah valid!";
      return false;
    }

    if(tanggal.value == ""){
      tanggal.style.backgroundColor="#ffcccb";
      status.style.color = "#EE4848";
      status.innerHTML = "Pastikan data sudah valid!";
      return false;
    }

    fetch('hilang-reservasi?tanggal='+tanggal.value+'&ktp='+ktp.value)
    .then(function(response){
      return response.text();
    }).then(function(result){
      let arr = JSON.parse(result);
      if(arr.length > 0){
        status.style.color = "black";
        status.innerHTML = "Ditemukan kode reservasi : ";
        for(let i = 0; i < arr.length; i++){
          if (i > 0){
            status.innerHTML += ", " + arr[i]["id_reservasi"];
          }else{
            status.innerHTML += arr[i]["id_reservasi"];
          }
        }
      }else{
        status.style.color = "#EE4848";
        status.innerHTML = "Kode reservasi untuk tanggal " + tanggal.value + " tidak ditemukan!";
      }
    });
  }

  function onDateChange(e){
    let kuota = document.getElementById("kuota");
    let select_jumlah = document.getElementById("jumlah-pengunjung");
    let harga_satuan = document.getElementById("harga"); //<paragraph>
    let harga_total = document.getElementById("total-harga");

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

          //sekalian harus fetch si harga nya juga
          fetch('getharga?tanggal='+tanggal.value)
            .then(function(response){
              return response.text();
            }).then(function(result){
              harga = result;
              harga_satuan.innerHTML = format_rupiah(harga);
              harga_total.innerHTML = format_rupiah(harga);
            });
        }else{
          kuota.innerHTML = "Tiket Habis";
          harga = 0;
          harga_satuan.innerHTML = "-";
          harga_total.innerHTML = "-";    
          kuota.style.color = "red";
        }
    });

    //rubah warna background tanggal jadi biru lagi
    let tanggal_selector = document.getElementById("tanggal");
    tanggal_selector.style.backgroundColor = "#DBE9FF";
    document.getElementById("err").style.visibility = 'hidden';
  }

  function clear_jumlah_pengunjung(elem){
    for(i = elem.options.length - 1; i >= 0; i--) elem.options[i] = null;
  }

  function onClick(e){
    let isValid = true;
    let ktp = document.getElementById("ktp");
    let nama = document.getElementById("nama");
    let telepon = document.getElementById("telepon");
    let tanggal = document.getElementById("tanggal");
    if(validate_ktp(ktp.value) == false){
      isValid = false;
      ktp.style.backgroundColor = "#ffcccb";
    }
    if(nama.value.length == 0){
      isValid = false;
      nama.style.backgroundColor = "#ffcccb";
    }
    if(validate_telepon(telepon.value) == false){
      isValid = false;
      telepon.style.backgroundColor = "#ffcccb";
    }

    if(harga == 0) {
      isValid = false; //tanggal yg dipilih masi salah
      tanggal.style.backgroundColor = "#ffcccb";
    }

    if(!isValid){
      e.preventDefault();
      document.getElementById("err").style.visibility = 'visible';
    }else{
      //masukkin kuota ke "post_kuota" untuk ikut dikirim. nantinya ini dipake buat bikin id registrasi
      document.getElementById("post-kuota").value = document.getElementById("kuota").innerHTML;
    }
  }

  function format_rupiah(money){
    money = parseInt(money);
    let formatter = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'IDR',
      maximumSignificantDigits: 3 //somehow ini ilangin si ,00 di belakang harga
    });

    return formatter.format(money);
  }

  function validate_ktp(ktp){
    if(ktp.length != 16) return false;
    for(let i = 0; i < 16; i++){
      if (ktp.charAt(i) >= '0' && ktp.charAt(i) <= '9') continue;
      else return false;
    }
    return true;
  }

  function validate_telepon(telepon){
    if(telepon.length < 7) return false;
    for(let i = 0; i < telepon.length; i++){
      if (telepon.charAt(i) >= '0' && telepon.charAt(i) <= '9') continue;
      else return false;
    }
  }

  init();
</script>