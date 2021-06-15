
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
        justify-content: center;
    }
    .title{
        color: #1A6793;
        font-size: 48px;
        text-align: center;
    }

    .buttons{
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 80%;
        left: 50%;
        transform: translate(-50%);
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
</style>

<?php
    //buat set html date supaya pemilik gabisa milih tanggal sebelumnya
    $today = new DateTime(date("Y-m-d"));
    $today->modify('+1 day');
    $today = $today->format("Y-m-d");
?>

<div class="white">
    <form method="POST" action="add-ticket">
        <h1 class="title">SET NEW TICKET</h1>
            <div class="login-box">
                <label class="fw-700 fs-18 c-dark-blue">DATE</label>
                <?php
                echo '<input name="tanggal" type="date" class="login-input fw-700 fs-36 bg-light-blue" style="font-size: 25px; font-weight: 500;" min="'.$today.'">';
                ?>
            </div>
            <div class="login-box" style="display: inline-block;">
                <label class="fw-700 fs-18 c-dark-blue">MAX TICKETS ALLOWED</label>
                <input name="jumlah-tiket" type="number" class="login-input fw-700 fs-36 bg-light-blue" style="width: 350px;">
                <span class="c-dark-blue" style="font-weight: 500; font-size: 30px;">tickets</span>
            </div>
            <br>
            <div class="login-box" style="display: inline-block;">
                <label class="fw-700 fs-18 c-dark-blue">MAX TICKETS ALLOWES / PARTY</label>
                <input name="max-tiket" type="number" class="login-input fw-700 fs-36 bg-light-blue" style="width: 350px;">
                <span class="c-dark-blue" style="font-weight: 500; font-size: 30px;">/ party</span>
            </div>
            <br>
             <div class="login-box" style="display: inline-block;">
                <label class="fw-700 fs-18 c-dark-blue">PRICE / TICKET</label>
                <input name="harga" type="number" class="login-input fw-700 fs-36 bg-light-blue" style="width: 350px;">
                <span class="c-dark-blue" style="font-weight: 500; font-size: 30px;">/ ticket</span>
            </div>


            <div class="buttons">
                <div style="margin-right: 10px; ">
                    <a href="tickets" class="back" style="background-color: #cf4a4a; color: white; "><span style="font-size: 30px;"> BACK </span> </a>
                </div>
                <div style="margin-right: 10px;">
                    <input type="submit" class="next" style="background-color: #2f549e; color: white;" value="➔">
                </div>
            </div>

            
    </form>
</div>



