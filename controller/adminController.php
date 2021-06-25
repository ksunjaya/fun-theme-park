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
    $page = 0;
    if(isset($_GET["page"])) $page = $_GET["page"];

    $query = 'SELECT transaksi.id_reservasi, transaksi.tanggal, transaksi.total_harga, reservasi.jml_orang
              FROM transaksi INNER JOIN reservasi ON transaksi.id_reservasi = reservasi.id_reservasi ';
    
    $dateFrom = "";
    $dateUntil = "";

    if (isset ($_GET['dateFrom']) && $_GET['dateFrom'] != "" && isset($_GET['dateUntil']) && $_GET['dateUntil'] != ""){
      $dateFrom = $_GET['dateFrom'];
      $dateUntil = $_GET['dateUntil'];
      $this->db->escapeString($dateFrom);
      $this->db->escapeString($dateUntil);
      $query.='WHERE transaksi.tanggal >= '."'".$dateFrom."'".' AND transaksi.tanggal <= '."'".$dateUntil."'";
    }else if (isset ($_GET['dateFrom']) && $_GET['dateFrom'] != ""){
      $dateFrom = $_GET['dateFrom'];
      $this->db->escapeString($dateFrom);
      $query.='WHERE transaksi.tanggal >= '."'".$dateFrom."'";
    }else if (isset($_GET['dateUntil']) && $_GET['dateUntil'] != ""){
      $dateUntil = $_GET['dateUntil'];
      $this->db->escapeString($dateUntil);
      $query.='WHERE transaksi.tanggal <= '."'".$dateUntil."'";
    }
    $query.=' ORDER BY transaksi.tanggal, transaksi.id_reservasi';
    
    $query_result = $this->changeVal($query);

    $last_page = (int)(count ($query_result) / 5);

    //untuk total income & total customer
    $sum = 0;
    $totalCustomer = 0;
    foreach ($query_result as $key => $value){
        $sum+=$value->getTotalPrice();
        $totalCustomer+=$value->getTotalTicket();
    }
    $totalIncome = $this->formatRupiah($sum);

    
    $query = $this->limitQuery($page, 5, $query);
    $result = $this->changeVal($query);

    return View::createAdminView('pemilik_log.php',[
      "result"=> $result,
      "query_result" => $query_result,
      "page"=> $page,
      "last_page"=>$last_page,
      "totalCustomer"=>$totalCustomer,
      "totalIncome"=>$totalIncome,
      "dateFrom"=>$dateFrom,
      "dateUntil"=>$dateUntil
    ]);
  }
  private function formatRupiah ($sum) { // untuk format rupiah
    $totalIncome = "";
    $sisa = (strlen($sum) % 3);
    if (strlen($sum)%3 == 0 && strlen($sum) > 3){
      $sisa = 3;
    }
    $totalIncome = substr($sum, 0, $sisa);
    for ($i = $sisa; $i < strlen($sum); $i+=3) {
      $totalIncome.=".".substr ($sum, $i, 3);
    }
    return $totalIncome;
  }
  private function changeVal ($query) {
    $query_result = $this->db->executeSelectQuery($query);
    $result = [];
    foreach ($query_result as $key => $value) {
      $result[] = new Log($value['tanggal'], $value['id_reservasi'], $value['jml_orang'], $value['total_harga']);
    }
    return $result;
  }
  private function limitQuery ($page, $count, $query){
    $page *= 5;
    $query .= ' LIMIT '.$page.','.$count;
    return $query;
  }
  private function getLogTransaksi($page, $count, $query){
    $page *= 5;
    $query .= ' LIMIT '.$page.','.$count;
    $query_result = $this->db->executeSelectQuery($query);
    $result = [];

    foreach ($query_result as $key => $value) {
        $result[] = new Log($value['tanggal'], $value['id_reservasi'], $value['jml_orang'], $value['total_harga']);
    }
    return $result;
  }
  public function createPDF () {
    $pdf = new FPDF('P', 'mm', 'A4'); //Potrait, Milimeter, Ukuran Kertas
    $pdf->AddPage();
    
    //set font
    $pdf->SetFont('Arial', 'B', 14); //arial bold 14
    
    //cell
    $pdf -> Cell(130, 5, 'FUN RESORT', 0, 0); //130 mm ke kanan, 5 mm ke bawah
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
    $pdf -> Cell(40, 5, '24-Jun-2021', 0, 1);

    $pdf -> Cell(10, 5, '', 0, 0);
    $pdf -> Cell(40, 5, 'Tanggal Selesai:', 0, 0);
    $pdf -> Cell(40, 5, '24-Jun-2021', 0, 1);

    $pdf -> Cell(189, 10, '', 0, 1);

    // tabel data

    //header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf -> Cell(47, 10, 'DATE', 1, 0,'C');
    $pdf -> Cell(47, 10, 'ID BOOKING', 1, 0, 'C');
    $pdf -> Cell(47, 10,  'TOTAL TICKET', 1, 0, 'C');
    $pdf -> Cell(48, 10,  'TOTAL PRICE', 1, 1, 'C');

    //data
    $pdf->SetFont('Arial', '', 12);
    for ($i=0; $i<100; $i++){
      $pdf -> Cell(47, 10, '24 June 2021', 1, 0,'C');
      $pdf -> Cell(47, 10, '210624273', 1, 0, 'C');
      $pdf -> Cell(47, 10,  '5', 1, 0, 'C');
      $pdf -> Cell(48, 10,  'Rp. 250.000', 1, 1, 'C');
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
    $pdf -> Cell(49, 5, 'Rp. 1.600.000', 0, 1);

    $pdf -> Cell(100, 5, '', 0, 0);
    $pdf -> Cell(40, 5, 'Total Customer', 0, 0);
    $pdf -> Cell(49, 5, '38', 0, 1);

    $pdf -> Cell(189, 20, '', 0, 1);

    $pdf->SetFont('Arial', 'I', 12);
    $pdf -> Cell(50, 5, '', 0, 0);
    $pdf -> Cell(89, 5, '~ Printed by Vincent Kurniawan ~', 0, 0, 'C');
    $pdf -> Cell(50, 5, '', 0, 1);

    //output
    $pdf->Output('I','fun-resort-log-transaksi.pdf'); //I supaya kita bisa liat di browser
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