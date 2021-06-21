<?php
define("MAX", 6); //jumlah row maksimum per halaman

require_once "services/mySQLDB.php";
require_once "services/view.php";
require_once "model/tiket.php";
require_once "model/log.php";
class AdminController{
  protected $db;

  public function __construct()
  {
    $this->db = new mySQLDB("localhost", "root", "", "fun_resort");
  }

  public function show_login(){
    return View::createAdminView("login_page.php", ["login" => true]);
  }

  public function show_main(){
    return View::createAdminView("pemilik_main.php", []);
  }

  //=====untuk page staff list=======
  public function view_staff_accounts(){
    require_once "controller/staffAccountController.php";
    $staff_acc_controller = new StaffAccountController();
    $last_page = ($staff_acc_controller->count_all()) / MAX;
    $page = 0; //set default nya dulu mo ada request dari GET ato engga
    if(isset($_GET["page"])) $page = $_GET["page"];

    $result = $staff_acc_controller->getAllStaff();
    return View::createAdminView('pemilik_staff_account.php',[
			"result"=> $result,
      "page"=>$page,
      "last_page"=>$last_page
		]);
  }

  //=====untuk page log transaksi======
  public function view_log(){
    $page = 0;
    if(isset($_GET["page"])) $page = $_GET["page"];

    $query = 'SELECT transaksi.id_reservasi, transaksi.tanggal, transaksi.total_harga, reservasi.jml_orang
              FROM transaksi INNER JOIN reservasi ON transaksi.id_reservasi = reservasi.id_reservasi 
              ORDER BY transaksi.tanggal';

    if (isset($_POST['dateFrom']) && $_POST['dateFrom'] != "" && isset($_POST['dateUntil']) && $_POST['dateUntil'] != ""){
      $dateFrom = $_POST['dateFrom'];
      $dateUntil = $_POST['dateUntil'];
      $this->db->escapeString($dateFrom);
      $this->db->escapeString($dateUntil);
      $query = 'SELECT transaksi.id_reservasi, transaksi.tanggal, transaksi.total_harga, reservasi.jml_orang
              FROM transaksi INNER JOIN reservasi ON transaksi.id_reservasi = reservasi.id_reservasi 
              WHERE transaksi.tanggal >= '."'".$dateFrom."'".' AND transaksi.tanggal <= '."'".$dateUntil."'".'
              ORDER BY transaksi.tanggal';
    }
    $result = $this->getLogTransaksi($page, MAX, $query);
    $last_page = count ($result) / MAX;
    return View::createAdminView('pemilik_log.php',[
      "result"=> $result,
      "page"=> $page,
      "last_page"=>$last_page
    ]);
  }

  private function getLogTransaksi($page, $count, $query){
    $query .= ' LIMIT '.$page.','.$count;
    $page *= MAX;
    $query_result = $this->db->executeSelectQuery($query);
    $result = [];

    foreach ($query_result as $key => $value) {
        $result[] = new Log($value['tanggal'], $value['id_reservasi'], $value['jml_orang'], $value['total_harga']);
    }
    return $result;
  }

  //=====untuk page tiket, OOP nya masih belum bagus tapi uda jalan=======
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