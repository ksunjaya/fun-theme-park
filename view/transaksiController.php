<?php
require_once "services/mySQLDB.php";
require_once "reservasiController.php";

class TransaksiController{
    protected $db;
    private $today;

    public function __construct(){
        $db = new MySQLDB("localhost", "root", "", "fun_resort");
        $today = new DateTime(date("ymd"));
        $today = $today->format("ymd"); //convert to string
    }

    //ini kalau manggilnya dari method POST
    public function _POST_AddTransaksi($isJSON = true){
        $id_transaksi = $_POST["id_transaksi"];
        $id_reservasi = $_POST["id_reservasi"];
        $tanggal = $POST["tanggal"];
        $total_harga = $POST["total_harga"];

        if($isJSON) return json_encode($this->addTransaksi($id_transaksi, $id_reservasi, $tanggal, $total_harga));
        else return $this->addTransaksi($id_transaksi, $id_reservasi, $tanggal, $total_harga);
    }

    private function addTransaksi($id_transaksi, $id_reservasi, $tanggal, $total_harga){
        //cek validitas reservasi
        $reservasi_ctrl = new ReservasiController();
        if($reservasi_ctrl->is_valid($id_reservasi, $today) == false) return false;

        //masukin query
        
    }  
}
?>