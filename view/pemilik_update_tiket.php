<style type="text/css">
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
		display: flex;
		justify-content: center;
		align-items: center;
		text-align: center;
		width: 246px;
		height: 69px;
		background-color: #DBE9FF;
		border-radius: 30px;
		margin: 15px;
		text-decoration: none;
		color: #1A6793;
		border: solid 3px #DBE9FF;
		transition: 0.1s;
	}

	.create:hover {
		background-color: white;
		transition: 0.1s;
		box-shadow: 0 2.8px 2.2px rgba(0, 0, 0, 0.034), 0 6.7px 5.3px rgba(0, 0, 0, 0.048), 0 12.5px 10px rgba(0, 0, 0, 0.06), 0 22.3px 17.9px rgba(0, 0, 0, 0.072), 0 41.8px 33.4px rgba(0, 0, 0, 0.086), 0 100px 80px rgba(0, 0, 0, 0.12);
		cursor: pointer;
	}

	.create h2 {
		font-size: 20px;
		font-family: Cairo;
		font-weight: 700;
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

	.footer-button {
		text-decoration: none;
		color: black;
	}
	.footer-button:hover {
		font-weight: 700;
		text-decoration: underline;
	}

</style>
<div class="white">
	<form method="POST" action="">
		<h1 class="title">TICKETS</h1>
		<div>
			<table>
				<tr>
					<th style="width: 200">DATE</th>
					<th style="width: 200">LIMIT/DAY</th>
					<th style="width: 200">LIMIT/PARTY</th>
					<th style="width: 200">REMAINING</th>
					<th style="width: 200">PRICE</th>
				</tr>

				<?php 
					foreach ($result as $key => $value) {
			 			echo "<tr>";
			 			echo "<td>".$value->getTanggal()."</td>";
			 			echo "<td>".$value->getLimit()."</td>";
			 			echo "<td>".$value->getMaxOrder()."</td>";
			 			echo "<td>".$value->getSisa()."</td>";
						echo "<td>".$value->getHarga()."</td>";
						echo "</tr>";
					}
		 				
				 ?>

			</table>
			
			<div class="buttons">
				<div>
					<?php
						if($page > 0) {
							//kalau di halaman 1 ga perlu tampilin tombol back
							$href = 'tickets?page='.($page - 1);
							echo '<a href="'.$href.'" class="back"><span> < </span> </a>'; 
						}
					?>
				</div>
				<div>
					<a href="add-ticket" class="create">
						<h2>SET NEW TICKET</h2>
					</a>
				</div>
				<div>
					<?php
						if($page < $last_page-1){
							//kalau halaman terkahir ga perlu tombol next
							$href = 'tickets?page='.($page + 1);
							echo '<a href="'.$href.'" class="next"><span> > </span> </a>'; 
						} 
					?>
				</div>
			</div>
			
			
			<div class="navs">
				<a class = "footer-button"href="main" style="margin-bottom: 40px;"><p>HOME</p></a>
				<a class = "footer-button"href="logout"><p>SIGN OUT</p></a>
			</div>
			
		</div>
	</form>
</div>



