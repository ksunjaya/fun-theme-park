<form id = "login-form" class="login-main" action="login" method="POST">
    <div class="login-content bg-white">
        <div class="login-h1-box" style="height: 30%;">
            <h1 class="c-dark-blue fs-48">LOGIN</h1>
        </div>
        <div class="login-isi" style="height: 30%;">
            <div class="login-box" style="margin-bottom: 50px;">
                <label class="fw-700 fs-18 c-dark-blue">USERNAME</label>
                <input name="username" id = "username" class="login-input fw-700 fs-36 bg-light-blue" type="text">
            </div>
            <div class="login-box">
                <label class="fw-700 fs-18 c-dark-blue">PASSWORD</label>
                <input name="password" id = "password" class="login-input fw-700 fs-36 bg-light-blue" type="password">
            </div>
        </div>
        <div class="footer-box-button" style="height: 40%;">
            <button type="submit" id="login" class="login-next-button c-white bg-dark-blue" href=""><span class="material-icons md-48">arrow_forward</span></button>
        </div>
    </div>
</form>

<script>
    function init () {
        let username = document.getElementById("username");
        let password = document.getElementById("password");
        let form = document.getElementById ("login-form");
    }
    init ();
</script>
