<?php
define("MAX", 6); //jumlah row maksimum per halaman

require_once "services/mySQLDB.php";
require_once "services/view.php";
require_once "model/tiket.php";
class AdminController{
  protected $db;

  public function __construct()
  {
    $this->db = new mySQLDB("localhost", "root", "", "fun_resort");
  }

  public function show_login(){
    return View::createAdminView("login_page.php", []);
  }

  public function show_main(){
    return View::createAdminView("pemilik_main.php", []);
  }

  public function show_create(){
    return View::createAdminView("coba.php", []);
  }

  //=====untuk page melihat tiket=======
  public function view_tiket(){
    //buat urusin pagination
  	require_once "controller/limitTiketController.php";
    $limitCtrl = new LimitTiketController();
    $last_page = ($limitCtrl->count_all()) / MAX;
    $page = 0;    //by default akan ke halaman 1
	  if(isset($_GET["page"])) $page = $_GET["page"];

    //fetch
    $result = $this->getAllTiket($page, MAX);
    return View::createAdminView('pemilik_update_tiket.php',[
      "result"=> $result,
      "page"=> $page,
      "last_page"=>$last_page
    ]);
  }

  private function getAllTiket($page, $count){
    $page *= MAX;
    $query = 'SELECT * 
              FROM limit_tiket INNER JOIN harga_tiket ON limit_tiket.tanggal = harga_tiket.tanggal 
              ORDER BY limit_tiket.tanggal
              LIMIT '.$page.','.$count;
    $query_result = $this->db->executeSelectQuery($query);
    $result = [];

    foreach ($query_result as $key => $value) {
        $result[] = new Tiket($value['tanggal'], $value['limit_harian'], $value['max_pesanan'], $value['sisa_tiket'], $value['harga']);
    }
    return $result;
  }

  public function createTicket(){
    $tanggal = $_POST["tanggal"];
    $max_tiket = $_POST["jumlah-tiket"];
    $max_party = $_POST["max-tiket"];
    $harga = $_POST["harga"];

    if(isset($tanggal) && isset($max_tiket) && isset($max_party) && isset($harga)){
      //bikin limit tiket dulu
      require_once "controller/limitTiketController.php";
      $limitCtrl = new LimitTiketController();
      $result = $limitCtrl->create_tiket($tanggal, $max_tiket, $max_party);
      if($result == true){
        //berhasil masukkin ke limit tiket, lanjut ke harga tiket
        require_once "controller/hargaTiketController.php";
        $hargaTiketCtrl = new HargaTiketController();
        $result = $hargaTiketCtrl->set_harga($tanggal, $harga);
        if($result == true) header("Location: tickets");
        else echo "Ada kesalahan pada sistem.";
      }else echo "Ada kesalahan pada sistem."; 
    }else echo "Beberapa attribut belum ke set dengan benar";
  }
  //=======================================
}
?>