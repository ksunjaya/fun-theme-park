<?php 
    //403 FORBIDDEN
    //404 NOT FOUND
    if($error_code == 404){
        $title = "Someone Ate The Page!";
        $message = "Or for some other reason, the page you're looking for cannot be located. Just in case, please check the URL.";
        $translation = "Halaman ini tidak dapat diakses. Mohon cek kembali alamat URL Anda.";
    }else if($error_code == 403){
        $title = "Oops, the gate is closed!";
        $message = "Our kingdom doesn't allowed you to enter this page. Please contact our guardians if this was a mistake.";
        $translation = "Saat ini Anda tidak memiliki akses untuk melihat halaman ini.";
    }else if($error_code == 001){
        $title = "Ticket's price is missing!";
        $message = "Server couldn't found today's ticket price. Please contact your administrator to solve this error.";
        $translation = "Pemilik belum menentukan harga tiket untuk hari ini. Mohon hubungi pemilik(administrator) untuk melengkapi administrasi hari ini.";
    }else if($error_code == 002){
        $title = "Oops, you can't reserve at the same day again!";
        $message = "You can only reserve one time at a day. Try to reserve for another day, or contact us if this was a mistake.";
        $translation = "Maaf, Anda tidak dapat mendaftar dua kali di hari yang sama. Silahkan mendaftar di hari lain.";
    }else if($error_code == 003){
        $title = "Someone Ate The Tickets!";
        $message = "Or for other reason, the tickets for the selected date is out. Or better, you can try another date!";
        $translation = "Tiket untuk tanggal yang anda pesan sudah habis, mohon memilih tanggal lainnya";
    }
?>

<div style="display: flex; justify-content: center; margin:5% 20%;">
    <div style="flex:1; padding-left: 13%;"><img src="src/stich.jpg"></div>
    <div style="flex:2; padding-top: 0%; padding-right: 13%; line-height: 1;">
        <h1 style="font-size: 35px;"><?php echo $title ?><h1><br>
        <p1 style="font-size: 20px; font-weight: 400;"><?php echo $message ?></p1>
        <br><br>
        <p1 style="font-size: 20px; font-style: italic; font-weight: 400;"><?php echo $translation ?></p1>
    </div>
</div>

<!-- yang ini tolong dibikin center pake CSS pengunjung, terus dibikin blue button -->
<div class="error-cont">
    <a class = "error-button" href="home">Take Me Home!</a>
</div>
<br>
<?php
//kalau errornya gegara harga tiket belom di set sama admin, perlu ada tombol sign out supaya admin bisa login dulu dan mendaftarkan harga tiket
if($error_code == 001){
    echo '
    <div class="error-cont">
        <a class = "error-button" href="logout">Log Out</a>
    </div>
    ';
}
?>