<?php
require_once "services/mySQLDB.php";
require_once "services/view.php";
class userController{
  protected $db;

  public function __construct()
  {
    $db = new mySQLDB("localhost", "root", "", "fun_resort");
  }

  public function show_home(){
    return View::createPengunjungView("home.php", []);
  }

  public function show_cari_tahu(){
    return View::createPengunjungView("pengunjung_cari_tahu.php", []);
  }

  public function show_post_booking(){
    $nama = $_POST['nama'];
    return View::createPengunjungView("pengunjung_post_booking.php", []);
  }


}
?>