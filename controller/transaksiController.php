<?php
require_once "services/mySQLDB.php";
require_once "reservasiController.php";
require_once "model/log.php";
require_once "fpdf183/fpdf.php";

class TransaksiController{
    protected $db;

    public function __construct(){
        $this->db = new MySQLDB("localhost", "root", "", "fun_resort");
        date_default_timezone_set('Asia/Jakarta');
    }

    //ini kalau manggilnya dari method POST
    public function _POST_AddTransaksi($isJSON = false){
        $id_transaksi = $this->generateUniqueID();
        $post = json_decode(file_get_contents('php://input'), true);
        $id_reservasi = $post["kode_reservasi"];
        $tanggal = date("ymd");
        $total_harga = $post["harga"];

        if($isJSON) return json_encode($this->addTransaksi($id_transaksi, $id_reservasi, $tanggal, $total_harga));
        else return $this->addTransaksi($id_transaksi, $id_reservasi, $tanggal, $total_harga);
    }

    private function generateUniqueID(){
        return date("ymdHis"); //year month date Hour Minute(with leading zeros) second(with l.z.)
    }

    private function addTransaksi($id_transaksi, $id_reservasi, $tanggal, $total_harga){
        //cek validitas reservasi
        $reservasi_ctrl = new ReservasiController();
        if($reservasi_ctrl->is_valid($id_reservasi, $tanggal) == false) return false;

        //masukin query
        $query = 'INSERT INTO Transaksi VALUES ("'.$id_transaksi.'", '.$id_reservasi.', "'.$tanggal.'", '.$total_harga.')';
        $query_result = $this->db->executeNonSelectQuery($query);

        //update reservasi, set ke "done"
        $query_result2 = $reservasi_ctrl->set_selesai($id_reservasi);
        return $query_result && $query_result2;
    }

    public function getAllTransaksi ($dateFrom, $dateUntil, $page, $count) {
        $page *= 5;
        $query = '  SELECT transaksi.id_reservasi, transaksi.tanggal, transaksi.total_harga, reservasi.jml_orang
                    FROM transaksi INNER JOIN reservasi ON transaksi.id_reservasi = reservasi.id_reservasi ';
        
        if ($dateFrom != "" && $dateUntil != ""){
            $this->db->escapeString($dateFrom);
            $this->db->escapeString($dateUntil);
            $query.='WHERE transaksi.tanggal >= '."'".$dateFrom."'".' AND transaksi.tanggal <= '."'".$dateUntil."'";
        }else if ($dateFrom != ""){
            $this->db->escapeString($dateFrom);
            $query.='WHERE transaksi.tanggal >= '."'".$dateFrom."'";
        }else if ($dateUntil != ""){
            $this->db->escapeString($dateUntil);
            $query.='WHERE transaksi.tanggal <= '."'".$dateUntil."'";
        }
        $query .=' ORDER BY transaksi.tanggal, transaksi.id_reservasi';
        $query .= ' LIMIT '.$page.','.$count;
        $query_result = $this->db->executeSelectQuery($query);

        $result = [];
        foreach ($query_result as $key => $value) {
            $result[] = new Log($value['tanggal'], $value['id_reservasi'], $value['jml_orang'], $value['total_harga']);
        }
        return $result;
    }
    public function getTotalIncomeCustomer ($query_result){
        $sum = 0;
        $totalCustomer = 0;
        foreach ($query_result as $key => $value){
            $sum+=$value->getTotalPrice();
            $totalCustomer+=$value->getTotalTicket();
        }
        $totalIncome = "";
        $sisa = (strlen($sum) % 3);
        if (strlen($sum)%3 == 0 && strlen($sum) > 3){
            $sisa = 3;
        }
        $totalIncome = substr($sum, 0, $sisa);
        for ($i = $sisa; $i < strlen($sum); $i+=3) {
            $totalIncome.=".".substr ($sum, $i, 3);
        }
        $res = array ($totalIncome, $totalCustomer);
        return $res;
    }

    public function get_stating_date(){
        $query= 'SELECT MIN(tanggal) AS min
                 FROM transaksi';
        $result = $this->db->executeSelectQuery($query);
        return $result[0]['min'];
    }

    public function get_ending_date(){
        $query= 'SELECT MAX(tanggal) AS max
                 FROM transaksi';
        $result = $this->db->executeSelectQuery($query);
        return $result[0]['max'];
    }

    //====CHART UTILITES=====
    //
    public function get_data_sum_pengunjung($awal, $akhir){
        $awal = $this->db->escapeString($awal);
        $akhir = $this->db->escapeString($akhir);
        $query='SELECT reservasi.tanggal, SUM(reservasi.jml_orang) AS "sum" 
                FROM transaksi INNER JOIN reservasi on transaksi.id_reservasi = reservasi.id_reservasi 
                WHERE reservasi.tanggal >= "'.$awal.'" AND reservasi.tanggal <= "'.$akhir.'"
                GROUP BY reservasi.tanggal';

        $result = $this->db->executeSelectQuery($query);

        return $result;
    }

    //=====PRINT LAPORAN=====
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
        $pdf -> Cell(130, 5, 'FUN RESORT AND THEME PARK', 0, 0);
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
}
?>