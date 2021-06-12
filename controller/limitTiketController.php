<?php
require_once "services/mySQLDB.php";
//require_once "services/view.php";

class limitTiketController{
  protected $db;

  public function __construct()
  {
    $this->db = new mySQLDB("localhost", "root", "", "fun_resort");
  }

  //kalau return NULL artinya libur / ato belom di set di database nya
  public function get_kuota(){
    $tanggal = $_GET["tanggal"];
    if(!isset($tanggal)) return NULL;
    else{
      $tanggal = $this->db->escapeString($tanggal);
      $query = 'SELECT max_pesanan, sisa_tiket FROM limit_tiket WHERE tanggal="'.$tanggal.'"';
      $query_result = $this->db->executeSelectQuery($query);

      if(count($query_result) > 0){
        return json_encode($query_result[0]); //harus cuman satu return nya
      }else NULL;
    }
  }
}
?>