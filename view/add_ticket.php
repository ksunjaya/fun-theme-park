<?php
  //yang mengandung php tolong jangan dirubah" dulu
  $today = new DateTime(date("Y-m-d"));
  $today->modify('+1 day');
  $today = $today->format("Y-m-d");
?>

<form action="create-ticket" method="POST">
  <label>DATE</label>
  <?php
  echo '<input type="date" name="tanggal" min="'.$today.'">';
  ?>
  <br>
  <label>MAX TICKETS ALLOWED</label>
  <input type="number" name="jumlah-tiket">
  <br>
  <label>MAX TICKETS ALLOWED / PARTY</label>
  <input type="number" name="max-tiket">
  <br>
  <label>PRICE/TICKET</label>
  <input type="text" name="harga">
  <br>
  <input type="submit" value="->">
</form>