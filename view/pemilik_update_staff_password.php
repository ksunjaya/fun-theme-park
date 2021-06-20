
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
</style> -->


<!-- <div class="white">
    <form method="POST" action="add-ticket">
        <h1 class="title">UPDATE PASSWORD</h1>
            <div class="login-box">
                <label class="fw-700 fs-18 c-dark-blue">USERNAME</label>
                <input name="username" type="text" class="login-input fw-700 fs-36 bg-light-blue" style="font-size: 25px; font-weight: 500; border: solid 3px;">
            </div>
            <div class="login-box">
                <label class="fw-700 fs-18 c-dark-blue">NEW PASSWORD</label>
                <input name="password" type="password" class="login-input fw-700 fs-36 bg-light-blue" style="font-size: 25px; font-weight: 500;">
            </div>
            <div class="login-box">
                <label class="fw-700 fs-18 c-dark-blue">RETYPE PASSWORD</label>
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



<form method="POST" action="updatepass" id="updatepass" class="login-main">
    <div class="login-content bg-white" style="width: 90%;">
        <div class="login-h1-box" style="height: 10%;">
            <h1 class="c-dark-blue fs-48">UPDATE PASSWORD</h1>
        </div>
        <div class="login-isi" style="height: 70%;" id="content">
            <div class="login-box" style="margin-bottom: 25px;">
                <label class="fw-700 fs-18 c-dark-blue">USERNAME</label>
                <input name="username" type="text" class="login-input fw-700 fs-36 bg-light-blue" style="font-size: 25px; font-weight: 500; border: solid 3px;" readonly="" value="<?php echo $username ?>" id="username">
            </div>
            <div class="login-box" id="pass-box" style="margin-bottom: 25px;">
                <label class="fw-700 fs-18 c-dark-blue">NEW PASSWORD</label>
                <input name="password" type="password" class="login-input fw-700 fs-36 bg-light-blue" style="font-size: 25px; font-weight: 500;" id="newpass">
            </div>
            <div class="login-box" id="retype-box" style="margin-bottom: 25px;">
                <label class="fw-700 fs-18 c-dark-blue">RETYPE PASSWORD</label>
                <input name="retype" type="password" class="login-input fw-700 fs-36 bg-light-blue" style="font-size: 25px; font-weight: 500;" id="retype">
            </div>
        </div>

            <div class="footer-box-button" style="height: 15%;">
                <div style="margin-right: 10px; ">
                    <a href="staffaccount" class="back" style="background-color: #cf4a4a; color: white; "><span style="font-size: 30px;"> BACK </span> </a>
                </div>
                <div style="margin-right: 10px;">
                    <input type="submit" class="next" style="background-color: #2f549e; color: white;" value="➔" id="update">
                </div>
            </div>
    </div>
</form> 


<div id="page"></div>
    <div id="alertbox">
        <div id="head"></div>
        <div id="body"></div>
        <div id="foot"></div>
    </div>
</div>

<script>
    
    let btn = document.getElementById('update');
    btn.addEventListener('click', validate);
    
    function validate(e){
        let newpass = document.getElementById('newpass');
        let retype = document.getElementById('retype');
        let box = document.getElementById('content');
        let warning = document.createElement("span");
        box.appendChild(warning);

        if(newpass.value=='' && retype.value==''){
            newpass.style.backgroundColor = "#e1001f";
            retype.style.backgroundColor = "#e1001f";
            warning.innerHTML = "* Masukkan password!";
            warning.style.fontSize = "20px";
            warning.style.color = "red";
        }
        else if(newpass.value==''){
            newpass.style.backgroundColor = "#e1001f";
            warning.innerHTML = "* Masukkan password!";
            warning.style.fontSize = "20px";
            warning.style.color = "red";
        }
        else if(retype.value==''){
            retype.style.backgroundColor = "#e1001f";
            warning.innerHTML = "* Masukkan kembali password!";
            warning.style.fontSize = "20px";
            warning.style.color = "red";
        }
        else if(newpass.value != retype.value){
            retype.style.backgroundColor = "#e1001f";
            warning.innerHTML = "* Password yang dimasukkan tidak cocok!";
            warning.style.fontSize = "20px";
            warning.style.color = "red";
        }
        else{
            popup(e);
        }

        newpass.addEventListener('input', function(e){
            newpass.style.backgroundColor = "#DBE9FF";
            warning.innerHTML = "";
        });
        retype.addEventListener('input', function(e){
            retype.style.backgroundColor = "#DBE9FF";
            warning.innerHTML = "";
        });

        e.preventDefault();
    }


    function popup(e){
        e.preventDefault();
        let page = document.getElementById('page');
        let alertbox = document.getElementById('alertbox');
        page.style.display = "block";
        alertbox.style.display = "block";
        let head = document.getElementById('head');
        head.innerHTML = "PASSWORD SUCCESSFULLY UPDATED FOR USERNAME";
        let username = document.getElementById('username').value;
        document.getElementById('body').innerHTML = '"' + username + '"';
        document.getElementById('foot').innerHTML = '<button id="ok">OK</button>';
        document.getElementById('ok').addEventListener('click',confirm);
    }

    function confirm(){
        document.getElementById('alertbox').style.display = "none";
        document.getElementById('page').style.display = "none";
        let form = document.getElementById('updatepass');
        form.submit();
    }

</script>


