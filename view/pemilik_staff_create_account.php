<form id = "login-form" class="login-main">
    <div class="login-content bg-white" style="width: 90%;">
        <div class="login-h1-box" style="height: 10%; margin-top:10px; margin-bottom:10px;">
            <h1 class="c-dark-blue fs-48">CREATE</h1>
        </div>
        <div class="login-isi" style="height: 70%; width: 80%;" id="box">
            <div class="login-box" style="margin-bottom: 20px;" id="ktp-box">
                <label class="fw-700 fs-18 c-dark-blue">ID NUMBER (KTP)</label>
                <input name="ktp" id = "ktp" class="login-input fw-700 fs-36 bg-light-blue" type="text" maxlength="16">
            </div>
            <div class="login-box" style="margin-bottom: 20px;">
                <label class="fw-700 fs-18 c-dark-blue">FULL NAME</label>
                <input name="fullname" id = "fullname" class="login-input fw-700 fs-36 bg-light-blue" type="text">
            </div>
            <div class="login-box" style="margin-bottom: 20px;" id="user-box">
                <label class="fw-700 fs-18 c-dark-blue">USERNAME</label>
                <input name="username" id = "username" class="login-input fw-700 fs-36 bg-light-blue" type="text">
            </div>
            <div class="login-box" style="margin-bottom: 20px;">
                <label class="fw-700 fs-18 c-dark-blue">PASSWORD</label>
                <input name="password" id = "password" class="login-input fw-700 fs-36 bg-light-blue" type="password">
            </div>
            <div class="login-box" style="margin-bottom: 20px;" id="photo-box">
                <label class="fw-700 fs-18 c-dark-blue">PHOTO</label>
                <input name="photo" id = "photo" class="login-input fw-700 fs-36 bg-light-blue" type="file">
            </div>
        </div>
        <div class="footer2-box-button" style="height: 15%;">
            <a href = "staff-list" class="login-back-button c-white" style = "margin-right:20px;" href=""><span class="txtButton">BACK</span></a>
            <button type="submit" id="btn-submit" class="login-next-button c-white bg-dark-blue" href=""><span class="txtButton">CREATE</span></button>
        </div>
    </div>
</form>

<script>
function init(){
    document.getElementById("btn-submit").addEventListener("click", onSubmit);
}

function onSubmit(e){
    e.preventDefault();

    if(validate() == false) return;
    //=====lengkapin formData=====
    let formData = new FormData();

    let fileField = document.querySelector("input[type='file']");
    formData.append('upfile', fileField.files[0]);

    let input_type_text = document.querySelectorAll("input[type='text']");
    for(let i = 0; i < input_type_text.length; i++){
        formData.append(input_type_text[i].name, input_type_text[i].value);
    }

    let password = document.querySelector("input[type='password']");
    formData.append("password", password.value);


    //====POST=====
    fetch('add-staff', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .catch(error => {
        console.error("Error when uploading image : ", error);  
    })
    .then(response =>{
        if(response["result"] == true){
            window.location = "staff-list";
        }else if(response["result"] == "error_copy"){
            console.error("Server error : unable to copy files");
        }else if(response["result"] == "format_error"){
            console.error("Only .jpeg and .png are allowed");
        }else if(response["result"] == "no_pic"){
            console.error("Please select a picture first!");
        }else{
            //ini artinya ada duplikat username.
            console.error("Please use another username!");

            let username = document.getElementById('username');
            let userbox = document.getElementById('user-box');
            let info = document.createElement("span");
            userbox.appendChild(info);
            username.style.backgroundColor = "#ffcccb";
            info.innerHTML = "Please use another username!";
            info.style.fontSize = "25px";
            info.style.color = "red";
            info.style.position = "absolute";
            info.style.whiteSpace = "nowrap";
            info.style.marginLeft = "10px";
            info.style.marginTop = "25px";
            userbox.style.display = "inline-block";

            username.addEventListener('input', function(e){
                username.style.backgroundColor = "#DBE9FF";
                info.innerHTML = " ";
            });
        }
    });
}   

function isNumber(ktp){
    for(let i = 0; i < 16; i++){
      if (ktp.charAt(i) >= '0' && ktp.charAt(i) <= '9') continue;
      else return false;
    }
    return true;
}

function validate(){
    let correct = true;
    let ktp = document.getElementById('ktp');
    let fullname = document.getElementById('fullname');
    let username = document.getElementById('username');
    let password = document.getElementById('password');
    let photo = document.getElementById('photo');

    let box = document.getElementById('box');
    let ktpbox = document.getElementById('ktp-box');
    let warning = document.createElement("span");

    if(ktp.value==''){
        ktp.style.backgroundColor = "#ffcccb";
        correct = false;
    }
    else if(ktp.value.length<16 || !isNumber(ktp.value)){
        ktpbox.appendChild(warning);
        ktp.style.backgroundColor = "#ffcccb";
        warning.innerHTML = "* Input tidak valid!";
        warning.style.fontSize = "25px";
        warning.style.color = "red";
        warning.style.position = "absolute";
        warning.style.whiteSpace = "nowrap";
        warning.style.marginLeft = "10px";
        warning.style.marginTop = "25px";
        ktpbox.style.display = "inline-block";
        correct = false;
    }
    if(fullname.value==''){
        fullname.style.backgroundColor = "#ffcccb";
        correct = false;
    }
    if(username.value==''){
        username.style.backgroundColor = "#ffcccb";
        correct = false;
    }
    if(password.value==''){
        password.style.backgroundColor = "#ffcccb";
        correct = false;
    }

    let photobox = document.getElementById('photo-box');
    let formatinfo = document.createElement("span");
    let len = photo.value.length;
    if(photo.value==''){
        photo.style.backgroundColor = "#ffcccb";
        correct = false;
    }
    else if(!(photo.value.substring(len-5) == ".jpeg" || photo.value.substring(len-4) ==".png" || photo.value.substring(len-4) ==".jpg")){
        photobox.appendChild(formatinfo);
        photo.style.backgroundColor = "#ffcccb";
        formatinfo.innerHTML = "Only .jpg .jpeg and .png are allowed";
        formatinfo.style.fontSize = "25px";
        formatinfo.style.color = "red";
        formatinfo.style.position = "absolute";
        formatinfo.style.whiteSpace = "nowrap";
        formatinfo.style.marginLeft = "10px";
        formatinfo.style.marginTop = "25px";
        photobox.style.display = "inline-block";
        correct = false;
    }

    ktp.addEventListener('input', function(e){
        ktp.style.backgroundColor = "#DBE9FF";
        warning.innerHTML = " ";
    });
    fullname.addEventListener('input', function(e){
        fullname.style.backgroundColor = "#DBE9FF";
    });
    username.addEventListener('input', function(e){
        username.style.backgroundColor = "#DBE9FF";
    });
    password.addEventListener('input', function(e){
        password.style.backgroundColor = "#DBE9FF";
    });
    photo.addEventListener('input', function(e){
        photo.style.backgroundColor = "#DBE9FF";
        formatinfo.innerHTML = " ";
    });
    return correct;
}

init();

</script>
