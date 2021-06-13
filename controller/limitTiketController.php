<?php
require_once "services/mySQLDB.php";
//require_once "services/view.php";

class LimitTiketController{
  protected $db;

  public function __construct()
  {
    $this->db = new mySQLDB("localhost", "root", "", "fun_resort");
  }

  public function get_kuota_json(){
    $tanggal = $_GET["tanggal"];
    $result = $this->get_kuota($tanggal);
    if($result == NULL) return NULL;
    else return json_encode($result);
  }
  //kalau return NULL artinya libur / ato belom di set di database nya
  public function get_kuota($tanggal){
    if(!isset($tanggal)) return NULL;
    else{
      $tanggal = $this->db->escapeString($tanggal);
      $query = 'SELECT max_pesanan, sisa_tiket FROM limit_tiket WHERE tanggal="'.$tanggal.'"';
      $query_result = $this->db->executeSelectQuery($query);

      if(count($query_result) > 0){
        return $query_result[0]; //harus cuman satu return nya
      }else NULL;
    }
  }

  public function update_tiket($sisa_tiket, $tanggal, $jumlah){
    if($jumlah < $sisa_tiket){
      $sisa = $sisa_tiket - $jumlah;
      $query = 'UPDATE limit_tiket SET sisa_tiket='.$sisa.' WHERE tanggal="'.$tanggal.'"';
      $query_result = $this->db->executeNonSelectQuery($query);
      return $query_result;
    }else return false; //kalo pas user ngeload web nya, si tiket tuh masi tersedia. tapi pas dipencet submit, ternyata uda keduluan orang laen
  }
}
?>