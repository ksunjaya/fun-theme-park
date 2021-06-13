<?php
require_once "services/mySQLDB.php";
require_once "services/view.php";

class PengunjungController{
  protected $db;
  public function __construct()
  {
    $this->db = new mySQLDB("localhost", "root", "", "fun_resort");    
  }

  public function getUser($ktp){
    if(isset($ktp)){
      $ktp = $this->db->escapeString($ktp);
      $query = 'SELECT * FROM pengunjung WHERE ktp = "'.$ktp.'"';
      $query_result = $this->db->executeSelectQuery($query);

      if(count($query_result) > 0){
        return $query_result[0]; //pasti cuman satu yang di return
      }else return false; //ga ada usernya
    }
  }

  public function addUser($ktp, $nama, $telepon){
    $query = 'INSERT INTO Pengunjung VALUES("'.$ktp.'", "'.$nama.'", "'.$telepon.'")';
    $result = $this->db->executeNonSelectQuery($query);
    return $result; //True kalo berhasil, false kalo gagal
  }

  //asumsinya uda di espace string semua
  public function updateUser($ktp, $nama, $telepon){
    $query = 'UPDATE Pengunjung SET nama="'.$nama.'", nomor_hp="'.$telepon.'" WHERE ktp="'.$ktp.'"';
    $query_result = $this->db->executeNonSelectQuery($query);

    return $query_result;
  }
}
?>