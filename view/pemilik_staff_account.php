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
			 			echo "<td id='username' name='username'>".$value->getNama()."</td>";
			 			echo "<td>".$value->getUsername()."</td>";
			 			echo "<td class ='action'> 
						<form method='POST' action='update' style='display:inline;'>
							<button type= 'submit' class = 'update-button' type='submit' name='update'>UPDATE</button>
							<input type='hidden' name='user' value='". $value->getUsername() ."'>
						</form>
						<form method='POST' action='delete' style='display:inline;' id='deletestaff'>
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
				<div>
					<?php
						if($page > 0) {
							//kalau di halaman 1 ga perlu tampilin tombol back
							$href = 'staff-list?page='.($page - 1);
							echo '<a href="'.$href.'" class="back"><span> < </span> </a>'; 
						}
					?>
				</div>
				<div>
					<a href="create-account" class="create" ><span>CREATE ACCOUNT<span></a>
				</div>
				<div>
					<?php
						if($page < $last_page-1){
							//kalau halaman terkahir ga perlu tombol next
							$href = 'staff-list?page='.($page + 1);
							echo '<a href="'.$href.'" class="next"><span> > </span> </a>'; 
						} 
					?>
				</div>
			</div>
			<div class="navs">
				<a href="main" class="footer-button ">HOME</a>
				<a href="logout " class="footer-button ">SIGN OUT</a>
			</div>
		</div>	
	</div>
</div>

<div id="page">
    <div id="alertbox">
        <div id="alertboxhead"></div>
        <div id="alertboxbody"></div>
        <div id="alertboxbody1"></div>
        <div id="alertboxfoot" style="margin-top: 40px;"></div>
    </div>
</div>



<script defer>
    //let btn = document.getElementById('delete');
    //btn.addEventListener('click', popup);  

		let arr_delete = document.getElementsByName("delete");
		for(let i = 0; i < arr_delete.length; i++){
			arr_delete[i].param = i;
			arr_delete[i].addEventListener('click', popup);
		}
    
    function popup(e){
      e.preventDefault();
      let page = document.getElementById('page');
      let alertbox = document.getElementById('alertbox');
      page.style.display = "block";
      alertbox.style.display = "block";
      let head = document.getElementById('alertboxhead');
      head.innerHTML = "YOU ARE ABOUT TO DELETE ACCOUNT WITH USERNAME";
      let arr_user = document.getElementsByName("username");
      document.getElementById('alertboxbody').innerHTML = '"' + arr_user[e.currentTarget.param].innerHTML + '"';
      document.getElementById('alertboxbody1').innerHTML =  "ARE YOU SURE?";
      document.getElementById('alertboxfoot').innerHTML = '<button id="no">NO</button><button id="yes">YES</button>';
      document.getElementById('yes').addEventListener('click',confirm);
      document.getElementById('no').addEventListener('click',cancel);
    }

    function confirm(){
      document.getElementById('alertbox').style.display = "none";
      document.getElementById('page').style.display = "none";
      let form = document.getElementById('deletestaff');
      form.submit();
    }

    function cancel(){
    	document.getElementById('alertbox').style.display = "none";
      document.getElementById('page').style.display = "none";
    }
</script>
