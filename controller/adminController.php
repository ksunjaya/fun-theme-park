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
    return View::createAdminView("login_page.php", ["login" => true]);
  }

  public function show_main(){
    return View::createAdminView("pemilik_main.php", []);
  }

  //=====untuk page staff list=======
  public function view_staff_accounts(){
    require_once "karyawanController.php";
    $karyawan_controller = new KaryawanController();
    $last_page = ($karyawan_controller->count_all()) / MAX;
    $page = 0; //set default nya dulu mo ada request dari GET ato engga
    if(isset($_GET["page"])) $page = $_GET["page"];

    $result = $karyawan_controller->getAllStaff($page, MAX);
    return View::createAdminView('pemilik_staff_account.php',[
			"result"=> $result,
      "page"=>$page,
      "last_page"=>$last_page
		]);
  }

  //=====untuk page log transaksi======
  public function view_log(){
    require_once "transaksiController.php";
    $transaksi = new TransaksiController();

    $page = 0;
    if(isset($_GET["page"])) $page = $_GET["page"];

    $dateFrom = "";
    $dateUntil = "";
    $minDateFrom = $transaksi->get_stating_date();
    $maxDateUntil = $transaksi->get_ending_date();
    if (isset ($_GET['dateFrom']) && $_GET['dateFrom'] != "" && isset($_GET['dateUntil']) && $_GET['dateUntil'] != ""){
      $dateFrom = $_GET['dateFrom'];
      $dateUntil = $_GET['dateUntil'];
    }else if (isset ($_GET['dateFrom']) && $_GET['dateFrom'] != ""){
      $dateFrom = $_GET['dateFrom'];
      $dateUntil = $maxDateUntil;
    }else if (isset($_GET['dateUntil']) && $_GET['dateUntil'] != ""){
      $dateUntil = $_GET['dateUntil'];
      $dateFrom = $minDateFrom;
    }else{
      //kalau dua duanya belum di set
      $dateFrom = $minDateFrom;
      $dateUntil = $maxDateUntil;
    }
    
    $chartResult = $transaksi->get_data_sum_pengunjung($dateFrom, $dateUntil);
    $chartResult2 = $transaksi->get_data_pendapatan_pengunjung($dateFrom, $dateUntil);

    // buat seluruh transaksi (ga di limit)
    $result2 = $transaksi->getAllTransaksi($dateFrom, $dateUntil, 0, PHP_INT_MAX);
    $last_page = (int)(count ($result2) / 5);
    $incomeCust = $transaksi->getTotalIncomeCustomer($result2);
    $totalIncome = $incomeCust[0];
    $totalCustomer = $incomeCust[1];

    // buat transaksi yang dilimit
    $result = $transaksi->getAllTransaksi($dateFrom, $dateUntil, $page, 5);

    // buat create view
    return View::createAdminView('pemilik_log.php',[
      "result"=> $result,
      "page"=> $page,
      "last_page"=>$last_page,
      "totalCustomer"=>$totalCustomer,
      "totalIncome"=>$totalIncome,
      "dateFrom"=>$dateFrom,
      "dateUntil"=>$dateUntil,
      "chartResult"=>$chartResult,
      "chartResult2"=>$chartResult2
    ]);
  }

  //=====untuk page tiket=======
  public function view_tiket(){
    //buat urusin pagination
  	require_once "controller/limitTiketController.php";
    $limitCtrl = new LimitTiketController();
    $last_page = ($limitCtrl->count_all()) / MAX;
    $page = 0;    //by default akan ke halaman 1
	  if(isset($_GET["page"])) $page = $_GET["page"];

    //fetch
    $result = $limitCtrl->getAllTiket($page, MAX);
    return View::createAdminView('pemilik_update_tiket.php',[
      "result"=> $result,
      "page"=> $page,
      "last_page"=>$last_page
    ]);
  }

  //dimasukkin ke sini soalnya pakai dua kelas entity
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