<?php
require_once "services/mySQLDB.php";
require_once "services/view.php";
require_once "limitTiketController.php";
class ReservasiController{
  protected $db;
  private $limit_tiket_ctrl;
  public function __construct()
  {
    $this->db = new mySQLDB("localhost", "root", "", "fun_resort");    
    $this->limit_tiket_ctrl = new LimitTiketController();
  }

  //$nomor bukan id_reservasi, tapi merupkaan unique number
  //yang diambil dari sisa tiket pada tanggal itu
  public function add_reservasi($nomor, $jumlah_orang, $ktp, $tanggal){
    $id = $this->create_unique_id($nomor, $tanggal);
    $query = 'INSERT INTO reservasi VALUES("'.$id.'", '.$jumlah_orang.', "'.$ktp.'", "'.$tanggal.'", 0)';

    $query_result = $this->db->executeNonSelectQuery($query);
    return $query_result;
  }

  public function HTTP_GET_reservasi(){
    if(isset($_GET["id"]) && isset($_GET["tanggal"]))
      return json_encode($this->get_reservasi($_GET["id"], $_GET["tanggal"]));
  }

  //cek apakah kode reservasi valid ato engga, cuman dipake pas staff pencet "print tiket"
  //karena hanya meng return true ato false tanpa info detailnya.
  public function is_valid($kode_reservasi, $tanggal){
    $result = $this->get_reservasi($kode_reservasi, $tanggal);
    return $result["status"] == true;
  }

  public function get_reservasi($kode_reservasi, $tanggal){
    $kode_reservasi = $this->db->escapeString($kode_reservasi);
    $tanggal = $this->db->escapeString($tanggal);
    $query = 'SELECT reservasi.jml_orang, pengunjung.nama, reservasi.tanggal, reservasi.selesai
              FROM reservasi INNER JOIN pengunjung ON reservasi.ktp = pengunjung.ktp 
              WHERE reservasi.id_reservasi="'.$kode_reservasi.'"'; //AND reservasi.tanggal="'.$tanggal.'"';
    $query_result = $this->db->executeSelectQuery($query);
    $details = array();
    if(count($query_result) == 0) $details["status"] = false; //kasi tau artinya gagal;
    else{
      $details["status"] = true;
      $details["tanggal"] = $query_result[0]["tanggal"];
      $details["jumlah"] = $query_result[0]["jml_orang"];
      $details["nama"] = $query_result[0]["nama"];
      $details["selesai"] = $query_result[0]["selesai"];
    }
    return $details;
  }

  public function json_reservasi_lost(){
    if(isset($_GET["ktp"]) && isset($_GET["tanggal"])){
      $ktp = $this->db->escapeString($_GET["ktp"]);
      $tanggal = $this->db->escapeString($_GET["tanggal"]);
      $query = 'SELECT reservasi.id_reservasi, reservasi.jml_orang FROM reservasi WHERE reservasi.ktp="'.$ktp.'" and reservasi.tanggal="'.$tanggal.'"';
      $query_result = $this->db->executeSelectQuery($query);

      return json_encode($query_result);
    }return "";
  }
  public function create_unique_id($nomor, $tanggal){
    $format_tanggal = new DateTime($tanggal);
    $format_tanggal = $format_tanggal->format('ymd'); //6 digit
    return $format_tanggal.''.$nomor;
  }

  public function set_selesai($id){
    $id = $this->db->escapeString($id);
    
    $query = 'UPDATE reservasi SET selesai=1 WHERE id_reservasi="'.$id.'"';
    $query_result = $this->db->executeNonSelectQuery($query);
    
    return $query_result;
  }

  //cek apakah user ini masih bisa memesan di hari yang sama?
  public function masih_bisa_pesan($ktp, $tanggal, $jml){
    $query = 'SELECT SUM(jml_orang) AS "sum"
              FROM reservasi
              WHERE ktp = "'.$ktp.'" AND tanggal = "'.$tanggal.'"';
    $query_result = $this->db->executeSelectQuery($query);

    $sum = $query_result[0]["sum"];
    $max = $this->limit_tiket_ctrl->get_max($tanggal);

    if($sum + $jml <= $max) return true;
    else return false;
  }
}
?>