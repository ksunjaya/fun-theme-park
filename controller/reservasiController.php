<?php
require_once "services/mySQLDB.php";
require_once "services/view.php";

class ReservasiController{
  protected $db;
  public function __construct()
  {
    $this->db = new mySQLDB("localhost", "root", "", "fun_resort");    
  }

  //$nomor bukan id_reservasi, tapi merupkaan unique number
  //yang diambil dari sisa tiket pada tanggal itu
  public function add_reservasi($nomor, $jumlah_orang, $ktp, $tanggal){
    $id = $this->create_unique_id($nomor, $tanggal);
    $query = 'INSERT INTO reservasi VALUES("'.$id.'", '.$jumlah_orang.', "'.$ktp.'", "'.$tanggal.'", 0)';

    $query_result = $this->db->executeNonSelectQuery($query);
    return $query_result;
  }

  public function HTTP_GET_reservasi(){
    if(isset($_GET["id"]) && isset($_GET["tanggal"]))
      return json_encode($this->get_reservasi($_GET["id"], $_GET["tanggal"]));
  }

  public function get_reservasi($kode_reservasi, $tanggal){
    $kode_reservasi = $this->db->escapeString($kode_reservasi);
    $tanggal = $this->db->escapeString($tanggal);
    $query = 'SELECT reservasi.jml_orang, pengunjung.nama, reservasi.tanggal, reservasi.selesai
              FROM reservasi INNER JOIN pengunjung ON reservasi.ktp = pengunjung.ktp 
              WHERE reservasi.id_reservasi="'.$kode_reservasi.'"'; //AND reservasi.tanggal="'.$tanggal.'"';
    $query_result = $this->db->executeSelectQuery($query);
    $details = array();
    if(count($query_result) == 0) $details["status"] = false; //kasi tau artinya gagal;
    else{
      $details["status"] = true;
      $details["tanggal"] = $query_result[0]["tanggal"];
      $details["jumlah"] = $query_result[0]["jml_orang"];
      $details["nama"] = $query_result[0]["nama"];
      $details["selesai"] = $query_result[0]["selesai"];
    }

    return $details;
  }

  public function create_unique_id($nomor, $tanggal){
    $format_tanggal = new DateTime($tanggal);
    $format_tanggal = $format_tanggal->format('ymd'); //6 digit
    return $format_tanggal.''.$nomor;
  }

  public function set_selesai($id){
    $id = $this->db->escapeString($id);
    
    $query = 'UPDATE transaksi SET selesai=1 WHERE id_reservasi="'.$id.'"';
    $query_result = $this->db->executeNonSelectQuery($query);
    
    return $query_result;
  }
}
?>