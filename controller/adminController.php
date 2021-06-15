<?php
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

  //=====untuk page melihat tiket=======
  public function view_tiket(){
    $result = $this->getAllTiket();
    return View::createAdminView('pemilik_update_tiket.php',[
      "result"=> $result
    ]);
  }

  public function getAllTiket(){
    $query = 'SELECT * FROM limit_tiket INNER JOIN harga_tiket ON limit_tiket.tanggal = harga_tiket.tanggal ORDER BY limit_tiket.tanggal';
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
        if($result == true) header("Location: showtiket");
        else echo "Ada kesalahan pada sistem.";
      }else echo "Ada kesalahan pada sistem."; 
    }else echo "Beberapa attribut belum ke set dengan benar";
  }
  //=======================================
}
?>