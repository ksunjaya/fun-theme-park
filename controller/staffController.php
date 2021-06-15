<?php
  require_once "services/mySQLDB.php";
  
  class StaffController{
    protected $db;

    public function __construct()
    {
      $db = new MySQLDB("localhost", "root", "", "fun_resort");
    }

    public function get_reservasi_attributes(){
      $kode = $_GET("kode");
      $result = array("status" => true);
      if(isset($kode)){
        $kode = $this->db->escapeString($kode);
        $query = 'SELECT Pengunjung.nama, Reservasi.jml_orang FROM Pengunjung INNER JOIN Reservasi ON Pengunjung.ktp = Reservasi.ktp WHERE Reservasi.id_reservasi="'.$kode.'"';
        $query_result = $this->db->executeSelectQuery($query);
        
        $result['nama'] = $query_result[0]["nama"];
        $result['jumlah'] = $query_result[0]["jml_orang"];
      }else $result["status"] = false;

      return $result;
    }
  }
?>