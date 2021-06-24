
<form method="POST" action="updatepass" id="updatepass" class="login-main">
    <div class="login-content bg-white" style="width: 90%;">
        <div class="login-h1-box" style="height: 10%; margin-top:50px; margin-bottom: 50px;">
            <h1 class="c-dark-blue fs-48">UPDATE PASSWORD</h1>
        </div>
        <div class="login-isi" style="height: 50%; margin-bottom: 25px" id="content">
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
        <div class="footer2-box-button" style="height: 15%;">
            <a href = "staff-list" class="login-back-button c-white" style = "margin-right:20px;" href=""><span class="txtButton">BACK</span></a>
            <button type="submit" id="btn-submit" class="login-next-button c-white bg-dark-blue" href=""><span class="txtButton">NEXT</span></button>
        </div>
    </div>
</form> 


<div id="page">
    <div id="alertbox">
        <div id="alertboxhead"></div>
        <div id="alertboxbody"></div>
        <div id="alertboxfoot"></div>
    </div>
</div>

<script>
    
    let btn = document.getElementById('btn-submit');
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
            warning.style.position = "absolute";
            warning.style.marginTop = "400px";
        }
        else if(newpass.value==''){
            newpass.style.backgroundColor = "#e1001f";
            warning.innerHTML = "* Masukkan password!";
            warning.style.fontSize = "20px";
            warning.style.color = "red";
            warning.style.position = "absolute";
            warning.style.marginTop = "400px";
        }
        else if(retype.value==''){
            retype.style.backgroundColor = "#e1001f";
            warning.innerHTML = "* Masukkan kembali password!";
            warning.style.fontSize = "20px";
            warning.style.color = "red";
            warning.style.position = "absolute";
            warning.style.marginTop = "400px";
        }
        else if(newpass.value != retype.value){
            retype.style.backgroundColor = "#e1001f";
            warning.innerHTML = "* Password yang dimasukkan tidak cocok!";
            warning.style.fontSize = "20px";
            warning.style.color = "red";
            warning.style.position = "absolute";
            warning.style.marginTop = "400px";
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
        let head = document.getElementById('alertboxhead');
        head.innerHTML = "PASSWORD SUCCESSFULLY UPDATED FOR USERNAME";
        let username = document.getElementById('username').value;
        document.getElementById('alertboxbody').innerHTML = '"' + username + '"';
        document.getElementById('alertboxfoot').innerHTML = '<button id="ok">OK</button>';
        document.getElementById('ok').addEventListener('click',confirm);
    }

    function confirm(){
        document.getElementById('alertbox').style.display = "none";
        document.getElementById('page').style.display = "none";
        let form = document.getElementById('updatepass');
        form.submit();
    }

</script>


