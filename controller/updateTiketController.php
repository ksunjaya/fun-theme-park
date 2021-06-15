<?php
require_once "services/mySQLDB.php";
require_once "services/view_admin.php";
require_once "model/tiket.php";

class UpdateTiketController{
  protected $db;

  public function __construct(){
    $this->db = new mySQLDB("localhost", "root", "", "fun_resort");
  }

  public function view_tiket(){
    $result = $this->getAllTiket();
    return View::createAdminView('pemilik_update_tiket.php',
        [
            "result"=> $result
        ]);
}

public function getAllTiket(){
    $query = "SELECT * FROM limit_tiket INNER JOIN harga_tiket ORDER BY tanggal";
    $query_result = $this->db->executeSelectQuery($query);
    $result = [];

    foreach ($query_result as $key => $value) {
        $result[] = new Tiket($value['tanggal'], $value['limit_harian'], $value['max_pesanan'], $value['sisa_tiket'], $value['harga']);
    }
    return $result;
}

}
?>
