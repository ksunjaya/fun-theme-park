<?php
require_once "services/mySQLDB.php";
//require_once "services/view.php";

class HargaTiketController{
  protected $db;

  public function __construct()
  {
    $this->db = new mySQLDB("localhost", "root", "", "fun_resort");
  }

  public function get_harga(){
    $tanggal = $_GET["tanggal"];
    if(isset($tanggal)){
      $tanggal = $this->db->escapeString($tanggal);
      $query = 'SELECT harga FROM harga_tiket WHERE tanggal="'.$tanggal.'"';
      $query_result = $this->db->executeSelectQuery($query);

      return $query_result[0]["harga"];
    }
  }
}
?>