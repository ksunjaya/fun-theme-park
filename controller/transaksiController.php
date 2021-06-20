<?php
require_once "services/mySQLDB.php";
require_once "reservasiController.php";

class TransaksiController{
    protected $db;
    private $today;

    public function __construct(){
        $this->db = new MySQLDB("localhost", "root", "", "fun_resort");
        $this->today = new DateTime(date("ymd"));
    }

    //ini kalau manggilnya dari method POST
    public function _POST_AddTransaksi($isJSON = false){
        $id_transaksi = $this->generateUniqueID();
        $post = json_decode(file_get_contents('php://input'), true);
        $id_reservasi = $post["kode_reservasi"];
        $tanggal = $this->today->format("ymd");
        $total_harga = $post["harga"];

        if($isJSON) return json_encode($this->addTransaksi($id_transaksi, $id_reservasi, $tanggal, $total_harga));
        else return $this->addTransaksi($id_transaksi, $id_reservasi, $tanggal, $total_harga);
    }

    private function generateUniqueID(){
        return $this->today->format("ymdHis"); //year month date Hour Minute(with leading zeros) second(with l.z.)
    }

    private function addTransaksi($id_transaksi, $id_reservasi, $tanggal, $total_harga){
        //cek validitas reservasi
        $reservasi_ctrl = new ReservasiController();
        if($reservasi_ctrl->is_valid($id_reservasi, $this->today->format("ymd")) == false) return false;

        //masukin query
        $query = 'INSERT INTO Transaksi VALUES ("'.$id_transaksi.'", '.$id_reservasi.', "'.$tanggal.'", '.$total_harga.')';
        $query_result = $this->db->executeNonSelectQuery($query);
        $result = array();
        $result["status"] = $query_result;
        return $query_result;
    }  
}
?>