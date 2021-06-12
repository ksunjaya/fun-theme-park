<?php
require_once "services/mySQLDB.php";
require_once "services/view.php";
class userController{
  protected $db;

  public function __construct()
  {
    $this->db = new mySQLDB("localhost", "root", "", "fun_resort");
  }

  public function show_home(){
    return View::createPengunjungView("home.php", []);
  }

  public function show_cari_tahu(){
    return View::createPengunjungView("pengunjung_cari_tahu.php", []);
  }

  public function show_post_booking(){
    $nama = $_POST['nama'];
    $tanggal = $_POST['tanggal'];
    return View::createPengunjungView("pengunjung_post_booking.php", [
      "nama"=> $nama,
      "tanggal"=> $tanggal
    ]);
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