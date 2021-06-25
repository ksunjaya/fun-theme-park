<?php
require_once "services/mySQLDB.php";
require_once "reservasiController.php";

class TransaksiController{
    protected $db;

    public function __construct(){
        $this->db = new MySQLDB("localhost", "root", "", "fun_resort");
        date_default_timezone_set('Asia/Jakarta');
    }

    //ini kalau manggilnya dari method POST
    public function _POST_AddTransaksi($isJSON = false){
        $id_transaksi = $this->generateUniqueID();
        $post = json_decode(file_get_contents('php://input'), true);
        $id_reservasi = $post["kode_reservasi"];
        $tanggal = date("ymd");
        $total_harga = $post["harga"];

        if($isJSON) return json_encode($this->addTransaksi($id_transaksi, $id_reservasi, $tanggal, $total_harga));
        else return $this->addTransaksi($id_transaksi, $id_reservasi, $tanggal, $total_harga);
    }

    private function generateUniqueID(){
        return date("ymdHis"); //year month date Hour Minute(with leading zeros) second(with l.z.)
    }

    private function addTransaksi($id_transaksi, $id_reservasi, $tanggal, $total_harga){
        //cek validitas reservasi
        $reservasi_ctrl = new ReservasiController();
        if($reservasi_ctrl->is_valid($id_reservasi, $tanggal) == false) return false;

        //masukin query
        $query = 'INSERT INTO Transaksi VALUES ("'.$id_transaksi.'", '.$id_reservasi.', "'.$tanggal.'", '.$total_harga.')';
        $query_result = $this->db->executeNonSelectQuery($query);

        //update reservasi, set ke "done"
        $query_result2 = $reservasi_ctrl->set_selesai($id_reservasi);
        return $query_result && $query_result2;
    }

    public function getAllTransaksi ($dateFrom, $dateUntil, $page, $count) {
        $page *= 5;
        $query = '  SELECT transaksi.id_reservasi, transaksi.tanggal, transaksi.total_harga, reservasi.jml_orang
                    FROM transaksi INNER JOIN reservasi ON transaksi.id_reservasi = reservasi.id_reservasi ';
        
        if ($dateFrom != "" && $dateUntil != ""){
            $this->db->escapeString($dateFrom);
            $this->db->escapeString($dateUntil);
            $query.='WHERE transaksi.tanggal >= '."'".$dateFrom."'".' AND transaksi.tanggal <= '."'".$dateUntil."'";
        }else if ($dateFrom != ""){
            $this->db->escapeString($dateFrom);
            $query.='WHERE transaksi.tanggal >= '."'".$dateFrom."'";
        }else if ($dateUntil != ""){
            $this->db->escapeString($dateUntil);
            $query.='WHERE transaksi.tanggal <= '."'".$dateUntil."'";
        }
        $query .=' ORDER BY transaksi.tanggal, transaksi.id_reservasi';
        $query .= ' LIMIT '.$page.','.$count;
        $query_result = $this->db->executeSelectQuery($query);

        $result = [];
        foreach ($query_result as $key => $value) {
            $result[] = new Log($value['tanggal'], $value['id_reservasi'], $value['jml_orang'], $value['total_harga']);
        }
        return $result;
    }
    public function getTotalIncomeCustomer ($query_result){
        $sum = 0;
        $totalCustomer = 0;
        foreach ($query_result as $key => $value){
            $sum+=$value->getTotalPrice();
            $totalCustomer+=$value->getTotalTicket();
        }
        $totalIncome = "";
        $sisa = (strlen($sum) % 3);
        if (strlen($sum)%3 == 0 && strlen($sum) > 3){
            $sisa = 3;
        }
        $totalIncome = substr($sum, 0, $sisa);
        for ($i = $sisa; $i < strlen($sum); $i+=3) {
            $totalIncome.=".".substr ($sum, $i, 3);
        }
        $res = array ($totalIncome, $totalCustomer);
        return $res;
    }

    public function get_stating_date(){
        $query= 'SELECT MIN(tanggal) AS min
                 FROM transaksi';
        $result = $this->db->executeSelectQuery($query);
        return $result[0]['min'];
    }

    public function get_ending_date(){
        $query= 'SELECT MAX(tanggal) AS max
                 FROM transaksi';
        $result = $this->db->executeSelectQuery($query);
        return $result[0]['max'];
    }

    //====CHART UTILITES=====
    //
    public function get_data_sum_pengunjung($awal, $akhir){
        $awal = $this->db->escapeString($awal);
        $akhir = $this->db->escapeString($akhir);
        $query='SELECT reservasi.tanggal, SUM(reservasi.jml_orang) AS "sum" 
                FROM transaksi INNER JOIN reservasi on transaksi.id_reservasi = reservasi.id_reservasi 
                WHERE reservasi.tanggal >= "'.$awal.'" AND reservasi.tanggal <= "'.$akhir.'"
                GROUP BY reservasi.tanggal';

        $result = $this->db->executeSelectQuery($query);

        return $result;
    }
}
?>