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
        <div class="login-h1-box" style="height: 10%; margin-top:10px; margin-bottom:10px;">
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

<script>
function init(){
    login-form.addEventListener("submit", onSubmit);
}

function onSubmit(e){
    let username_text = document.getElementById("username");

    let formData = new FormData();
    let fileField = document.querySelector("input[type='file']");

    let status = true;
    formData.append('upfile', fileField.files[0]);

    fetch('upload-staff-picture?username=' + username_text.value, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .catch(error => {
        console.error("Error when uploading image : ", error);
        status = false;
    })
    .then(response =>{
        
    });

    if(status==false) e.preventDefault();
}

init();
</script>


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
</form>

