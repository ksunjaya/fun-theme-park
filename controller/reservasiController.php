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
    $query = 'INSERT INTO reservasi VALUES("'.$id.'", '.$jumlah_orang.', "'.$ktp.'", "'.$tanggal.'")';

    $query_result = $this->db->executeNonSelectQuery($query);
    return $query_result;
  }

  public function create_unique_id($nomor, $tanggal){
    $format_tanggal = new DateTime($tanggal);
    $format_tanggal = $format_tanggal->format('ymd'); //6 digit
    return $format_tanggal.''.$nomor;
  }
}
?>