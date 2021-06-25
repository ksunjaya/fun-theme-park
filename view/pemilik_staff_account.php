<?php
	require_once "model/staff.php";
?>

<div class="login-main">
	<div class="login-content bg-white" style="width: 90%;">
		<div class="login-h1-box" style="height: 10%;">
            <h1 class="c-dark-blue fs-48">STAFF ACCOUNT</h1>
        </div>
		<div class="login-isi" style="height: 70%; flex-direction: row; align-items: flex-start;">
			<table style="margin-top: 40px; width: 1200px;">
				<tr>
					<th>NOMOR INDUK</th>
					<th>NAMA LENGKAP</th>
					<th>USERNAME</th>
					<th>ACTIONS</th>
				</tr>
				<?php 
					foreach ($result as $key => $value) {
			 			echo "<tr>";
			 			echo "<td>".$value->getKtp()."</td>";
			 			echo "<td id='username' name='fullname'><a href='' id='photo' style='text-decoration: none; color: black;'>".$value->getNama()."</a></td>";
			 			echo "<td name='username'>".$value->getUsername()."
						 	<input type='hidden' name='photolocation' value='". $value->getPhotoLocation() ."'>
						 	</td>";
			 			echo "<td class ='action'> 
						<form method='POST' action='update' style='display:inline;'>
							<button type= 'submit' class = 'update-button' type='submit' name='update'>UPDATE</button>
							<input type='hidden' name='user' value='". $value->getUsername() ."'>
						</form>
						<form method='POST' action='delete' style='display:inline;' name='form-delete'>
							<button class = 'update-button' type='submit' name='delete'>DELETE</button>
							<input type='hidden' name='user' value='". $value->getUsername() ."' id='user'>
						</form>
							</td>";
						echo "</tr>";
					}
				?>
			</table>
		</div>
		<div class="footer-box-button" style="height: 10%;">	
			<div class="buttons">
				<?php
					if($page > 0) {
						//kalau di halaman 1 ga perlu tampilin tombol back
						$href = 'staff-list?page='.($page - 1);
						echo '<a href="'.$href.'" class="login-next-button log-table-next-button" style="width: 80px; height: 80px; margin-right: 15px;"><span class="material-icons md-48">chevron_left</span></a>';
					}
				?>
				<a href="create-account" class="create" ><span>CREATE ACCOUNT<span></a>
				<?php
					if($page < $last_page-1){
						//kalau halaman terkahir ga perlu tombol next
						$href = 'staff-list?page='.($page + 1);
						echo '<a href="'.$href.'" class="login-next-button log-table-next-button" style="width: 80px; height: 80px; margin-left: 15px;"><span class="material-icons md-48">chevron_right</span></a>';
					} 
				?>
			</div>
			<div class="navs">
				<a href="main" class="footer-button ">HOME</a>
				<a href="logout " class="footer-button ">SIGN OUT</a>
			</div>
		</div>	
	</div>
</div>

<div id="page" class="page">
    <div id="alertbox" class="alertbox">
        <div id="alertboxhead" class="alertboxhead"></div>
        <div id="alertboxbody" class="alertboxbody"></div>
        <div id="alertboxbody1" class="alertboxbody1"></div>
        <div id="alertboxfoot" class="alertboxfoot" style="margin-top: 40px;"></div>
    </div>
</div>

<div id="photopage" class="page">
    <div id="alertphoto" class="alertbox">
        <div id="alertphotohead" class="alertboxhead" style="margin-top: 0px";></div>
        <div id="alertphotobody" class="alertboxbody"></div>
        <div id="alertphotofoot" class="alertboxfoot" style="margin-top: 0px;"></div>
    </div>
</div>

<script defer>
		/*let arr_location = document.getElementsByName('photolocation');
		for(let i = 0; i < arr_location.length; i++){
			console.log(arr_location[i].value);
		}*/

		let arr_delete = document.getElementsByName("delete");
		for(let i = 0; i < arr_delete.length; i++){
			arr_delete[i].param = i;
			arr_delete[i].addEventListener('click', popup);
		}

		let arr_photo = document.getElementsByName("fullname");
		for(let i = 0; i < arr_photo.length; i++){
			arr_photo[i].param = i;
			arr_photo[i].addEventListener('click', photo);
		}	
		let img = document.createElement('img');

    function popup(e){
		e.preventDefault();
		let page = document.getElementById('page');
		let alertbox = document.getElementById('alertbox');
		page.style.display = "block";
		alertbox.style.display = "block";
		let head = document.getElementById('alertboxhead');
		head.innerHTML = "YOU ARE ABOUT TO DELETE ACCOUNT WITH USERNAME";
		let arr_user = document.getElementsByName("username");
				let arr_form = document.getElementsByName("form-delete");
		document.getElementById('alertboxbody').innerHTML = '"' + arr_user[e.currentTarget.param].innerHTML + '"';
		document.getElementById('alertboxbody1').innerHTML =  "ARE YOU SURE?";
		document.getElementById('alertboxfoot').innerHTML = '<button onClick="cancel()" id="no">NO</button><button id="yes">YES</button>';
				document.getElementById('yes').param = arr_form[e.currentTarget.param]
				document.getElementById('yes').addEventListener('click', confirmation);
    }

    function confirmation(e){
		document.getElementById('alertbox').style.display = "none";
		document.getElementById('page').style.display = "none";
				console.log(e.currentTarget.param);
		let form = e.currentTarget.param;
		form.submit();
    }

    function cancel(e){
    	document.getElementById('alertbox').style.display = "none";
      	document.getElementById('page').style.display = "none";
  	}

	function photo(e){
		let page = document.getElementById('photopage');
		let alertbox = document.getElementById('alertphoto');
		page.style.display = "block";
		alertbox.style.display = "block";
		alertbox.style.height = "500px";
		let arr_user = document.getElementsByName("username");
		let head = document.getElementById('alertphotohead');
		head.innerHTML = arr_user[e.currentTarget.param].innerHTML;
		head.style.fontSize = "50px"; 
		head.style.color = "black";
		let body = document.getElementById('alertphotobody');
		body.appendChild(img);
		let arr_location = document.getElementsByName('photolocation');
		img.src = arr_location[e.currentTarget.param].value;
		// img.src = "src/stich.jpg";
		img.style.height = "300px";
		img.style.width = "250px";
		document.getElementById('alertphotofoot').innerHTML = '<button id="ok">OK</button>';
		document.getElementById('ok').addEventListener('click',closePhoto);
		e.preventDefault();
	}

  function closePhoto(){
      document.getElementById('alertphoto').style.display = "none";
      document.getElementById('photopage').style.display = "none";
	  img.src = "";
  }

</script>
