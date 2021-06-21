<div class="login-main">
	<div class="login-content bg-white" style="width: 90%;">
		<div class="login-h1-box" style="height: 10%; width: 100%">
            <h1 class="c-dark-blue fs-48">TICKETS</h1>
        </div>
		<div class="login-isi" style="height: 60%; flex-direction: row; align-items: flex-start;">
			<table style="margin-top: 40px; width: 1200px;">
				<tr>
					<th>DATE</th>
					<th>LIMIT/DAY</th>
					<th>LIMIT/PARTY</th>
					<th>REMAINING</th>
					<th>PRICE</th>
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
		</div>
		<div class="footer-box-button">
			<div class="buttons">
				<?php
				if($page > 0) {
					//kalau di halaman 1 ga perlu tampilin tombol back
					$href = 'tickets?page='.($page - 1);
					echo '<a href="'.$href.'" class="login-next-button log-table-next-button" style="width: 80px; height: 80px; margin-right: 15px;"><span class="material-icons md-48">chevron_left</span></a>';
					// echo '<a href="'.$href.'" class="back"><span> < </span> </a>'; 
				}
				?>
				<a href="add-ticket" class="create">
					<span>SET NEW TICKET</span>
				</a>
				<?php
					if($page < $last_page-1){
						//kalau halaman terkahir ga perlu tombol next
						$href = 'tickets?page='.($page + 1);
						echo '<a href="'.$href.'" class="login-next-button log-table-next-button" style="width: 80px; height: 80px; margin-left: 15px;"><span class="material-icons md-48">chevron_right</span></a>';
						// echo '<a href="'.$href.'" class="next"><span> > </span> </a>'; 
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
