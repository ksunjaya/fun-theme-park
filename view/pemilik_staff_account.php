<?php
	require_once "model/staff.php";
?>
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

</style>


<div class="white">
	<form method="POST" action="">
		<h1 class="title">STAFF ACCOUNT</h1>
		<div>
			<table>
				<tr>
					<!-- <th style="width: 300;">NOMOR INDUK</th>
					<th style="width: 350;">NAMA LENGKAP</th>
					<th style="width: 250;">USERNAME</th>
					<th style="width: 300;">ACTIONS</th> -->
					<th>NOMOR INDUK</th>
					<th>NAMA LENGKAP</th>
					<th>USERNAME</th>
					<th>ACTIONS</th>
				</tr>
				<!--<tr>
					<td>1234123412341234</td>
					<td>Wombat</td>
					<td>womwom</td>
					<td class="action">
						<input type="submit" name="update" value="UPDATE">
						<input type="submit" name="delete" value="DELETE">
					</td>
				</tr>
				<tr>
					<td>1234123412341234</td>
					<td>Dodo</td>
					<td>doremi123</td>
					<td class="action">
						<input type="submit" name="update" value="UPDATE">
						<input type="submit" name="delete" value="DELETE">
					</td>
				</tr>
				<tr>
					<td>1234123412341234</td>
					<td>Dodo</td>
					<td>doremi123</td>
					<td class="action">
						<input type="submit" name="update" value="UPDATE">
						<input type="submit" name="delete" value="DELETE">
					</td>
				</tr>
				<tr>
					<td>1234123412341234</td>
					<td>Dodo</td>
					<td>doremi123</td>
					<td class="action">
						<input type="submit" name="update" value="UPDATE">
						<input type="submit" name="delete" value="DELETE">
					</td>
				</tr>
				<tr>
					<td>1234123412341234</td>
					<td>Dodo</td>
					<td>doremi123</td>
					<td class="action">
						<input type="submit" name="update" value="UPDATE">
						<input type="submit" name="delete" value="DELETE">
					</td>
				</tr>
				<tr>
					<td>1234123412341234</td>
					<td>Dodo</td>
					<td>doremi123</td>
					<td class="action">
						<input type="submit" name="update" value="UPDATE">
						<input type="submit" name="delete" value="DELETE">
					</td>
				</tr> -->
				
				<?php 
					foreach ($result as $key => $value) {
			 			echo "<tr>";
			 			echo "<td>".$value->getKtp()."</td>";
			 			echo "<td>".$value->getNama()."</td>";
			 			echo "<td>".$value->getUsername()."</td>";
			 			echo "<td class ='action'> 
			 				<input type='submit' name='update' value='UPDATE'>
							<input type='submit' name='delete' value='DELETE'>
							</td>";
						echo "</tr>";
					}
		 				
				 ?>
				

			</table>
			
			<div class="buttons">
				<div>
					<a href="" class="back"><span> < </span> </a>
				</div>
				<div>
					<input type="submit" name="create" value="CREATE ACCOUNT" class="create" >
				</div>
				<div>
					<a href="" class="next"><span> > </span> </a>
				</div>
			</div>
			
			
			<div class="navs">
				<a href=""><p style="line-height: 6;">HOME</p></a>
				<a href=""><p>SIGN OUT</p></a>
			</div>
			
		</div>
	</form>
</div>


