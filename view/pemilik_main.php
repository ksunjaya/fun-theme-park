
<div id = "login-form" class="login-main" action="" method="POST">

    <div class="nama-user">
        <span class="material-icons md-36" style="margin-right: 10px;">account_box</span>
        <h1 style="margin-right: 50px; font-size: 36px; font-weight: 700;"><?php echo $nama_user?></h1>
    </div>
    <div class="login-content bg-white">
        <div class="login-h1-box" style="height: 25%;">
            <h1 class="c-dark-blue fs-48">HOME</h1>
        </div>
        <div class="login-isi" style="height: 50%;">
           <a href = "staff-list"class="button main-margin-button"><h2>STAFF ACCOUNT</h2></a>
           <a href = "tickets"class="button main-margin-button"><h2>UPDATE TICKET</h2></a>
           <a href = "log-transaksi"class="button"><h2>VIEW TRANSACTION</h2></a>
        </div>
        <div class="login-isi" style="height: 25%;">
            <a href = "logout" class="footer-button">SIGN OUT</a>
        </div>
    </div>
</div>