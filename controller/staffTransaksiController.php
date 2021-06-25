<?php
  require_once "services/mySQLDB.php";
  require_once "services/view.php";
  class StaffController{
    protected $db;

    public function __construct()
    {
      $this->db = new MySQLDB("localhost", "root", "", "fun_resort");
    }

    public function get_reservasi_attributes(){
      $kode = $_GET("kode");
      $result = array("status" => true);
      if(isset($kode)){
        $kode = $this->db->escapeString($kode);
        $query = 'SELECT Pengunjung.nama, Reservasi.jml_orang FROM Pengunjung INNER JOIN Reservasi ON Pengunjung.ktp = Reservasi.ktp WHERE Reservasi.id_reservasi="'.$kode.'"';
        $query_result = $this->db->executeSelectQuery($query);
        
        $result['nama'] = $query_result[0]["nama"];
        $result['jumlah'] = $query_result[0]["jml_orang"];
      }else $result["status"] = false;

      return $result;
    }

    public function viewAll(){
      return View::createStaffView("transaksi_staff.php", []);
    }

    // membuat pdf struk tiket
    public function createPDF () {
      require_once "fpdf183/fpdf.php";

      $idReservasi = $_GET['idReservasi'];

      $query = ' SELECT pengunjung.nama, reservasi.jml_orang, reservasi.tanggal, transaksi.total_harga
                 FROM reservasi INNER JOIN pengunjung ON reservasi.ktp = pengunjung.ktp INNER JOIN transaksi ON transaksi.id_reservasi = reservasi.id_reservasi
                 WHERE reservasi.id_reservasi = "'.$idReservasi.'"';

      $query_result = $this->db->executeSelectQuery($query);

      $nama = $query_result[0]["nama"];
      $jmlOrang = $query_result[0]["jml_orang"];
      $tanggal = $query_result[0]["tanggal"];
      $totalHarga = $query_result[0]["total_harga"];

      $sum = $totalHarga;
      $totalIncome = "";
      $sisa = (strlen($sum) % 3);
      if (strlen($sum)%3 == 0 && strlen($sum) > 3){
          $sisa = 3;
      }
      $totalIncome = substr($sum, 0, $sisa);
      for ($i = $sisa; $i < strlen($sum); $i+=3) {
          $totalIncome.=".".substr ($sum, $i, 3);
      }

      $pdf = new FPDF('P', 'mm', 'A4');
      $pdf->AddPage();

      $pdf->SetFont('Arial', 'B', 14);
      $pdf->Cell(95, 5, 'FUN RESORT AND THEME PARK', 0, 0);
      $pdf->Cell(95, 5, 'INVOICE', 0, 1, 'R');

      $pdf->SetFont('Arial', '', 14);
      $pdf->Cell(190, 20, '', 0, 1);

      $pdf->SetFont('Arial', 'B', 14);
      $pdf->Cell(20, 5, '', 0, 0);
      $pdf->Cell(95, 5, 'DETAILS', 0, 1);

      $pdf->Cell(190, 10, '', 0, 1);

      $pdf->SetFont('Arial', '', 14);
      $pdf->Cell(20, 5, '', 0, 0);
      $pdf->Cell(50, 5, 'ATAS NAMA', 0, 0);
      $pdf->Cell(120, 5, $nama, 0, 1);

      $pdf->Cell(190, 5, '', 0, 1);

      $pdf->Cell(20, 5, '', 0, 0);
      $pdf->Cell(50, 5, 'JUMLAH TIKET', 0, 0);
      $pdf->Cell(120, 5, $jmlOrang, 0, 1);

      $pdf->Cell(190, 5, '', 0, 1);

      $pdf->Cell(20, 5, '', 0, 0);
      $pdf->Cell(50, 5, 'TOTAL HARGA', 0, 0);
      $pdf->Cell(120, 5, 'Rp. '.$totalIncome, 0, 1);

      $pdf->Cell(190, 5, '', 0, 1);

      $pdf->Cell(20, 5, '', 0, 0);
      $pdf->Cell(50, 5, 'TANGGAL', 0, 0);
      $pdf->Cell(120, 5, $tanggal, 0, 1);

      $pdf->Cell(190, 20, '', 0, 1);

      $pdf->SetFont('Arial', 'B', 14);
      $pdf->Cell(20, 10, '', 0, 0);
      $pdf->Cell(20, 10, 'NO', 1, 0, 'C');
      $pdf->Cell(130, 10, 'KODE RESERVASI', 1, 0, 'C');
      $pdf->Cell(20, 10, '', 0, 1);

      $str = $idReservasi;

      $pdf->SetFont('Arial', '', 14);
      for ($i=1; $i<=$jmlOrang; $i++){
        $pdf->Cell(20, 10, '', 0, 0);
        $pdf->Cell(20, 10, $i, 1, 0, 'C');
        $pdf->Cell(130, 10, $str.'-'.$i, 1, 0, 'C');
        $pdf->Cell(20, 10, '', 0, 1);
      }

      $pdf->Cell(190, 20, '', 0, 1);

      $pdf->SetFont('Arial', 'I', 14);
      $pdf->Cell(40, 10, '', 0, 0);
      $pdf->Cell(110, 10, '~ Have a Great Day ! ~', 0, 0, 'C');
      $pdf->Cell(40, 10, '', 0, 1);

      //output (print)
      $pdf -> Output("", "invoice.pdf");
    }
  }
?>