<?php
define("MAX", 6); //jumlah row maksimum per halaman

require_once "services/mySQLDB.php";
require_once "services/view.php";
require_once "model/tiket.php";
require_once "model/log.php";
require_once "fpdf183/fpdf.php";

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
      "chartResult"=>$chartResult
    ]);
  }

  public function createPDF () {
    require_once 'transaksiController.php';

    $dateFrom = "";
    $dateUntil = "";
    $totalIncome = 0;
    $totalCustomer = 0;
    $nama = "";
    if (isset($_POST['dateFrom']) && isset($_POST['dateUntil']) && isset($_POST['totalIncome']) && $_POST['totalIncome'] != "" && isset($_POST['totalCustomer']) && $_POST['totalCustomer'] != "" && isset($_POST['nama']) && $_POST['nama'] != "") {
      $dateFrom = $_POST['dateFrom'];
      $dateUntil = $_POST['dateUntil'];
      $totalIncome = $_POST['totalIncome'];
      $totalCustomer = $_POST['totalCustomer'];
      $nama = $_POST['nama'];
    }

    $transaksi = new TransaksiController();
    $result = $transaksi->getAllTransaksi($dateFrom, $dateUntil, 0, PHP_INT_MAX);

    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();
    
    //set font
    $pdf->SetFont('Arial', 'B', 14);
    
    //cell
    $pdf -> Cell(130, 5, 'FUN RESORT', 0, 0);
    $pdf -> Cell(59, 5, 'LOG-TRANSAKSI', 0, 1, 'R');

    //set font
    $pdf->SetFont('Arial', '', 12);

    // cell kosong untuk space vertical
    $pdf -> Cell(189, 10, '', 0, 1);
    
    $pdf -> Cell(189, 5, 'Keterangan', 0, 1);

    $pdf -> Cell(189, 5, '', 0, 1);
    
    $pdf->SetFont('Arial', '', 12);
    $pdf -> Cell(10, 5, '', 0, 0);
    $pdf -> Cell(40, 5, 'Tanggal Mulai:', 0, 0);
    $pdf -> Cell(40, 5, $dateFrom, 0, 1);

    $pdf -> Cell(10, 5, '', 0, 0);
    $pdf -> Cell(40, 5, 'Tanggal Selesai:', 0, 0);
    $pdf -> Cell(40, 5, $dateUntil, 0, 1);

    $pdf -> Cell(189, 10, '', 0, 1);

    // tabel data

    //header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf -> Cell(47, 10, 'DATE', 1, 0,'C');
    $pdf -> Cell(47, 10, 'ID BOOKING', 1, 0, 'C');
    $pdf -> Cell(47, 10,  'TOTAL TICKET', 1, 0, 'C');
    $pdf -> Cell(48, 10,  'TOTAL PRICE', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 12);
    foreach ($result as $key => $value){
      $pdf -> Cell(47, 10, $value->getDate(), 1, 0,'C');
      $pdf -> Cell(47, 10, $value->getIdBooking(), 1, 0, 'C');
      $pdf -> Cell(47, 10, $value->getTotalTicket(), 1, 0, 'C');
      $pdf -> Cell(48, 10, $value->getFormattedPrice(), 1, 1, 'C');
    }

    //summary
    $pdf -> Cell(189, 10, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 12);

    $pdf -> Cell(100, 5, '', 0, 0);
    $pdf -> Cell(89, 5, 'SUMMARY', 0, 1);

    $pdf -> Cell(189, 5, '', 0, 1);

    $pdf->SetFont('Arial', '', 12);
    $pdf -> Cell(100, 5, '', 0, 0);
    $pdf -> Cell(40, 5, 'Total Income', 0, 0);
    $pdf -> Cell(49, 5, 'Rp. '.$totalIncome, 0, 1);

    $pdf -> Cell(100, 5, '', 0, 0);
    $pdf -> Cell(40, 5, 'Total Customer', 0, 0);
    $pdf -> Cell(49, 5, $totalCustomer, 0, 1);

    $pdf -> Cell(189, 20, '', 0, 1);

    $pdf->SetFont('Arial', 'I', 12);
    $pdf -> Cell(50, 5, '', 0, 0);
    $pdf -> Cell(89, 5, '~ Printed by '.$nama.' ~', 0, 0, 'C');
    $pdf -> Cell(50, 5, '', 0, 1);

    //output
    $pdf->Output('I','fun-resort-log-transaksi.pdf');
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