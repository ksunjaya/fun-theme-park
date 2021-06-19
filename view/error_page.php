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
<a href="home" style="margin: auto; display: block;">Take Me Home!</a>