
<!-- <style type="text/css">

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
        width: 600px;
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
</style> -->


<!-- <div class="white">
    <form method="POST" action="add-ticket">
        <h1 class="title">CREATE</h1>
            <div class="login-box">
                <label class="fw-700 fs-18 c-dark-blue">ID NUMBER(KTP)</label>
                <input name="idnum" type="text" class="login-input fw-700 fs-36 bg-light-blue" style="font-size: 25px; font-weight: 500;">
            </div>
            <div class="login-box">
                <label class="fw-700 fs-18 c-dark-blue">FULL NAME</label>
                <input name="name" type="text" class="login-input fw-700 fs-36 bg-light-blue" style="font-size: 25px; font-weight: 500;">
            </div>
            <div class="login-box">
                <label class="fw-700 fs-18 c-dark-blue">USERNAME</label>
                <input name="username" type="text" class="login-input fw-700 fs-36 bg-light-blue" style="font-size: 25px; font-weight: 500;">
            </div>
            <div class="login-box">
                <label class="fw-700 fs-18 c-dark-blue">PASSWORD</label>
                <input name="password" type="password" class="login-input fw-700 fs-36 bg-light-blue" style="font-size: 25px; font-weight: 500;">
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
</div> -->

<!-- Revisi: -->
<form id = "login-form" class="login-main" action="createaccount" method="POST">
    <div class="login-content bg-white">
        <div class="login-h1-box" style="height: 10%;">
            <h1 class="c-dark-blue fs-48">CREATE</h1>
        </div>
        <div class="login-isi" style="height: 70%;">
            <div class="login-box" style="margin-bottom: 20px;">
                <label class="fw-700 fs-18 c-dark-blue">ID NUMBER (KTP)</label>
                <input name="ktp" id = "ktp" class="login-input fw-700 fs-36 bg-light-blue" type="text" maxlength="16">
            </div>
            <div class="login-box" style="margin-bottom: 20px;">
                <label class="fw-700 fs-18 c-dark-blue">FULL NAME</label>
                <input name="fullname" id = "fullname" class="login-input fw-700 fs-36 bg-light-blue" type="text">
            </div>
            <div class="login-box" style="margin-bottom: 20px;">
                <label class="fw-700 fs-18 c-dark-blue">USERNAME</label>
                <input name="username" id = "username" class="login-input fw-700 fs-36 bg-light-blue" type="text">
            </div>
            <div class="login-box" style="margin-bottom: 20px;">
                <label class="fw-700 fs-18 c-dark-blue">PASSWORD</label>
                <input name="username" id = "password" class="login-input fw-700 fs-36 bg-light-blue" type="text">
            </div>
            <div class="login-box" style="margin-bottom: 20px;">
                <label class="fw-700 fs-18 c-dark-blue">PHOTO</label>
                <input name="photo" id = "photo" class="login-input fw-700 fs-36 bg-light-blue" type="file">
            </div>
        </div>
        <div class="footer2-box-button" style="height: 15%;">
            <a href = "staff-list" class="login-back-button c-white" style = "margin-right:20px;" href=""><span class="material-icons md-48">arrow_back</span></a>
            <button type="submit" class="login-next-button c-white bg-dark-blue" href=""><span class="material-icons md-48">arrow_forward</span></button>
        </div>
    </div>
</form>


<!-- Punya Kezia :  -->
<!-- <form id = "login-form" class="login-main" action="createaccount" method="POST">
    <div class="login-content bg-white" style="width: 90%;">
        <div class="login-h1-box" style="height: 10%;">
            <h1 class="c-dark-blue fs-48">CREATE</h1>
        </div>
        <div class="login-isi" style="height: 70%;">
            <div class="login-box" style="margin-bottom: 25px;">
                <label class="fw-700 fs-18 c-dark-blue">ID NUMBER (KTP)</label>
                <input name="ktp" id = "ktp" class="login-input fw-700 fs-36 bg-light-blue" type="text" maxlength="16">
            </div>
            <div class="login-box" style="margin-bottom: 25px;">
                <label class="fw-700 fs-18 c-dark-blue">FULL NAME</label>
                <input name="name" id = "fullname" class="login-input fw-700 fs-36 bg-light-blue" type="text">
            </div>
            <div class="login-box" style="margin-bottom: 25px;">
                <label class="fw-700 fs-18 c-dark-blue">USERNAME</label>
                <input name="username" id = "username" class="login-input fw-700 fs-36 bg-light-blue" type="text">
            </div>
            <div class="login-box" style="margin-bottom: 25px;">
                <label class="fw-700 fs-18 c-dark-blue">PASSWORD</label>
                <input name="password" id = "password" class="login-input fw-700 fs-36 bg-light-blue" type="password">
            </div>
            <div class="login-box">
                <label class="fw-700 fs-18 c-dark-blue">PHOTO</label>
                <input name="photo" id = "photo" class="login-input fw-700 fs-36 bg-light-blue" type="file" style="font-size: 25px;">
            </div>
        </div>
        <div class="footer-box-button" style="height: 15%;">
            <div style="margin-right: 10px;">
                <a href="staff-list" class="back" style="background-color: #cf4a4a; color: white; "><span style="font-size: 30px;"> BACK </span> </a>
            </div>
            <div style="margin-right: 10px;">
                <input type="submit" class="next" style="background-color: #2f549e; color: white;" value="➔">
            </div>
        </div>
    </div>
</form> -->
