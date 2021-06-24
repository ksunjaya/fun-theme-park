
<style type="text/css">

@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&family=Lato:wght@400;500;600;700;900&display=swap');
    body {
        background-color: #DBE9FF;
        font-family: Cairo;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .white {
        background-color: white;
        width: 90%;
        height: 90%;
        border-radius: 30px;
        border: solid 6px #266E97;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .title{
        margin-top: 25px;
        margin-bottom: 25px;
        color: #1A6793;
        font-size: 48px;
        text-align: center;
    }

    .buttons{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .back, .next{
        background-color: #DBE9FF;
        color: #1A6793;
        border: none;
        border-radius: 30px;
        padding: 8px 32px 8px 32px;
        font-size: 40px;
        font-family: Cairo;
        font-weight: 500;
        text-decoration: none;
    }


    .c-dark-blue {
        color: #1A6793;
    }
    .fw-700 {
        font-weight: 700;
    }
    .fs-18 {
        font-size: 18px;
    }
    .fs-36 {
        font-size: 36px;
    }
    .bg-light-blue {
        background-color: #DBE9FF;
    }

    .login-isi {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 80%;
    }

    .login-input {
        border: 3px transparent;
        height: 80px;
        width: 500px;
        padding-left: 15px;
        padding-top: 20px;
        background-color: #DBE9FF;
        transition: 0.1s;
        font-family: Cairo;
    }

    .login-box {
        display: flex;
        flex-direction: column;
        margin-bottom: 40px;
        position: relative;
    }
    .login-box label {
        position: absolute;
        top: 5px;
        left: 15px;
    }
    .login-back-button {
        border: solid 3px #EE4848;
    }


</style>

<?php
    //buat set html date supaya pemilik gabisa milih tanggal sebelumnya
    $today = new DateTime(date("Y-m-d"));
    //$today->modify('+1 day');
    $today = $today->format("Y-m-d");
?>

<form method = "POST" action="add-ticket" class="white">
    <h1 class="title">SET NEW TICKET</h1>    
    <div class="login-box">
        <label class="fw-700 fs-18 c-dark-blue">DATE</label>
        <?php
        echo '<input name="tanggal" type="date" class="login-input fw-700 fs-36 bg-light-blue" style="width: 440px;font-size: 25px; font-weight: 500;" min="'.$today.'">';
        ?>
    </div>
    <div class="login-box" style="display: inline-block;">
        <label class="fw-700 fs-18 c-dark-blue">MAX TICKETS ALLOWED</label>
        <input name="jumlah-tiket" type="number" class="login-input fw-700 fs-36 bg-light-blue" style="width: 350px;">
        <span class="c-dark-blue" style="font-weight: 500; font-size: 30px;">tickets</span>
    </div>
    <div class="login-box" style="display: inline-block;">
        <label class="fw-700 fs-18 c-dark-blue">MAX TICKETS ALLOWES / PARTY</label>
        <input name="max-tiket" type="number" class="login-input fw-700 fs-36 bg-light-blue" style="width: 350px;">
        <span class="c-dark-blue" style="font-weight: 500; font-size: 30px;">/ party</span>
    </div>
    <div class="login-box" style="display: inline-block;">
        <label class="fw-700 fs-18 c-dark-blue">PRICE / TICKET</label>
        <input name="harga" type="number" class="login-input fw-700 fs-36 bg-light-blue" style="width: 350px;">
        <span class="c-dark-blue" style="font-weight: 500; font-size: 30px;">/ ticket</span>
    </div>
    <div class="buttons">
        <a class="login-back-button c-white" href="tickets" style="width: 94px; height:94px; margin-right:10px;"><span class="txtButton">BACK</span></a>
        <button type="submit" class="login-next-button c-white bg-dark-blue" ><span class="txtButton">NEXT</span></button>
        
    </div>
</form>



