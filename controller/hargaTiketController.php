<?php
require_once "services/mySQLDB.php";
//require_once "services/view.php";

class HargaTiketController{
  protected $db;

  public function __construct()
  {
    $this->db = new mySQLDB("localhost", "root", "", "fun_resort");
  }

  public function _request_harga(){
    $tanggal = $_GET["tanggal"];
    return $this->get_harga($tanggal);
  }

  public function get_harga($tanggal){
    if(isset($tanggal)){
      $tanggal = $this->db->escapeString($tanggal);
      $query = 'SELECT harga FROM harga_tiket WHERE tanggal="'.$tanggal.'"';
      $query_result = $this->db->executeSelectQuery($query);

      if(count($query_result) > 0) return $query_result[0]["harga"];
      else return false;//echo "INTERNAL ERROR : Harga tiket untuk tanggal ".$tanggal." tidak dapat ditemukan.";
    }
  }

  public function set_harga($tanggal, $harga){
    //asumsi uda ada tanggal sama harga nya
    $tanggal = $this->db->escapeString($tanggal);
    $harga = $this->db->escapeString($harga);

    $query = 'INSERT INTO harga_tiket VALUES("'.$tanggal.'",'.$harga.' )';
    $query_result = $this->db->executeNonSelectQuery($query);

    return $query_result;
  }
}
?>