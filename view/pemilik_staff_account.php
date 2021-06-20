<?php
	require_once "model/staff.php";
?>

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
	table, tr, td, th {
	  border: 1px solid black;
	  border-collapse: collapse;
	  text-align: center;
	}
	table {
		width: 1200;
	}
	th{
		height: 65px;
		font-size: 25px;
	}
	tr{
		height: 55px;
		font-size: 20px;
	}
	.action input{
		background-color: #DBE9FF;
		color: #1A6793;
		border: none;
		border-radius: 30px;
		padding: 5px 25px 5px 25px;
		font-size: 16px;
		font-family: Cairo;
		font-weight: 600;
	}

	.buttons{
		display: flex;
	    justify-content: center;
	    align-items: center;
		position: fixed;
	  	top: 70%;
	  	left: 50%;
	  	transform: translate(-50%);
	}

	.create{
		background-color: #DBE9FF;
		color: #1A6793;
		border: none;
		border-radius: 20px;
		padding: 12px 14px 12px 14px;
		font-size: 20px;
		font-family: Cairo;
		font-weight: 700;
		margin: 15px;

	}

	.back, .next{
		background-color: #DBE9FF;
		color: #1A6793;
		border: none;
		border-radius: 20px;
		padding: 0px 25px 0px 25px;
		font-size: 40px;
		font-family: Cairo;
		font-weight: 500;
		text-decoration: none;
	}

	.navs{
		display: flex;
	    justify-content: center;
	}

	.navs a{
		text-decoration: none;
		color: black;
		font-weight: 600;
		position: fixed;
		bottom: 70px;
	}

</style> -->



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
			 			echo "<td id='username'>".$value->getNama()."</td>";
			 			echo "<td>".$value->getUsername()."</td>";
			 			echo "<td class ='action'> 
						<form method='POST' action='update' style='display:inline;'>
							<input type='submit' name='update' value='UPDATE'>
							<input type='hidden' name='user' value='". $value->getUsername() ."'>
						</form>
						<form method='POST' action='delete' style='display:inline;' id='deletestaff'>
							<input type='submit' name='delete' value='DELETE' id='delete'>
							<input type='hidden' name='user' value='". $value->getUsername() ."' id='user'>
						</form>
							</td>";
						echo "</tr>";
					}
				?>
			</table>
		</div>
		<div class="footer-box-button" style="height: 10%;">	
			<!-- <div class="buttons">
				<div>
					<a href="" class="back"><span> < </span> </a>
				</div>
				<div>
					<a href="create-account" class="create" ><span>CREATE ACCOUNT<span></a>
				</div>
				<div>
					<a href="" class="next"><span> > </span> </a>
				</div>
			</div> -->

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



<script>
    
    let btn = document.getElementById('delete');
    btn.addEventListener('click', popup);  
    
    function popup(e){
        e.preventDefault();
        let page = document.getElementById('page');
        let alertbox = document.getElementById('alertbox');
        page.style.display = "block";
        alertbox.style.display = "block";
        let head = document.getElementById('alertboxhead');
        head.innerHTML = "YOU ARE ABOUT TO DELETE ACCOUNT WITH USERNAME";
        let username = document.getElementById('user').value;
        document.getElementById('alertboxbody').innerHTML = '"' + username + '"';
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
