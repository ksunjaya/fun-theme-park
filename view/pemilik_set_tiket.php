<?php
    //buat set html date supaya pemilik gabisa milih tanggal sebelumnya
    $today = new DateTime(date("Y-m-d"));
    //$today->modify('+1 day');
    $today = $today->format("Y-m-d");
?>

<form method="POST" action="add-ticket" class="login-main">
    <div class="login-content bg-white" style="width: 90%;">
        <div class="login-h1-box" style="height: 20%;">
            <h1 class="c-dark-blue fs-48">SET NEW TICKET</h1>
        </div>
        <div class="login-isi" style="height: 60%; margin-bottom: 25px">
            <div class="login-box" style="margin-bottom: 25px;">
                <label class="fw-700 fs-18 c-dark-blue">DATE</label>
                <?php
                echo '<input name="tanggal" type="date" class="login-input fw-700 fs-36 bg-light-blue" style="width: 440px;font-size: 25px; font-weight: 500;" min="'.$today.'">';
                ?>
            </div>
            <div class="login-box" style="margin-bottom: 25px; display: inline-block;">
                <label class="fw-700 fs-18 c-dark-blue">MAX TICKETS ALLOWED</label>
                <input name="jumlah-tiket" type="number" class="login-input fw-700 fs-36 bg-light-blue" style="width: 350px;">
                <span class="c-dark-blue" style="font-weight: 500; font-size: 30px;">tickets</span>
            </div>
            <div class="login-box" style="margin-bottom: 25px; display: inline-block;">
                <label class="fw-700 fs-18 c-dark-blue">MAX TICKETS ALLOWES / PARTY</label>
                <input name="max-tiket" type="number" class="login-input fw-700 fs-36 bg-light-blue" style="width: 350px;">
                <span class="c-dark-blue" style="font-weight: 500; font-size: 30px;">/ party</span>
            </div>
            <div class="login-box" style="margin-bottom: 25px; display: inline-block;">
                <label class="fw-700 fs-18 c-dark-blue">PRICE / TICKET</label>
                <input name="harga" type="number" class="login-input fw-700 fs-36 bg-light-blue" style="width: 350px;">
                <span class="c-dark-blue" style="font-weight: 500; font-size: 30px;">/ ticket</span>
            </div>
        </div>
        <div class="footer-box-button" style="height: 10%;">
            <div class="buttons">
                <a class="login-back-button c-white" href="tickets" style="width: 94px; height:94px; margin-right:10px;"><span class="txtButton">BACK</span></a>
                <button type="submit" class="login-next-button c-white bg-dark-blue" ><span class="txtButton">NEXT</span></button> 
            </div>
        </div>
    </div>
</form>



