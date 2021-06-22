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
