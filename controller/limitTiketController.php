<?php
require_once "services/mySQLDB.php";

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

  public function create_tiket($tanggal, $max_ticket, $max_party){
    //asumsi semua param uda pasti ada isinya
    $tanggal = $this->db->escapeString($tanggal);
    $max_ticket = $this->db->escapeString($max_ticket);
    $max_party = $this->db->escapeString($max_party);

    $query = 'INSERT INTO limit_tiket VALUES("'.$tanggal.'", '.$max_ticket.', '.$max_party.', '.$max_ticket.')';
    $query_result = $this->db->executeNonSelectQuery($query);

    return $query_result; //TRUE kalo berhasil
  }

  public function count_all(){
    $query = 'SELECT COUNT(tanggal) AS "count" FROM limit_tiket';
    $query_result = $this->db->executeSelectQuery($query);

    if($query == false) return false;
    else{
      return $query_result[0]['count'];
    }
  }

  public function get_max($tanggal){
    $query = 'SELECT max_pesanan FROM limit_tiket WHERE tanggal = "'.$tanggal.'"';
    $query_result = $this->db->executeSelectQuery($query);

    return $query_result[0]['max_pesanan'];
  }
}
?>