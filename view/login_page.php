<form class="login-main" action="" method="POST">
    <div class="login-content bg-white">
        <div class="login-h1-box">
            <h1 class="c-dark-blue fs-48">LOGIN</h1>
        </div>
        <div class="login-isi">
            <div class="login-box">
                <label class="fw-700 fs-18 c-dark-blue">USERNAME</label>
                <input id = "username" class="login-input fw-700 fs-36 bg-light-blue" type="text">
            </div>
            <div class="login-box">
                <label class="fw-700 fs-18 c-dark-blue">PASSWORD</label>
                <input id = "password" class="login-input fw-700 fs-36 bg-light-blue" type="password">
            </div>
            <a class="login-next-button c-white bg-dark-blue" href=""><span class="material-icons md-48">arrow_forward</span></a>
        </div>
    </div>
</form>

<script>
    function init () {
        let username = document.querySelector('#username');
        let password = document.querySelector('#password');
        
    }
    init ();
</script>
