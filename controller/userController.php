<?php
require_once "services/mySQLDB.php";
require_once "services/view.php";
require_once "reservasiController.php";
require_once "pengunjungController.php";
require_once "limitTiketController.php";

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

  //jml dan kode
  public function show_post_booking(){
    $ktp = $this->db->escapeString($_POST["ktp"]);
    $nama = $this->db->escapeString($_POST['nama']);
    $telepon = $this->db->escapeString($_POST['telepon']);
    $tanggal = $this->db->escapeString($_POST['tanggal']);
    $jml = $this->db->escapeString($_POST['jml']);
    //$kuota = $this->db->escapeString($_POST['kuota']);
    
    $pengunjung_ctrl = new PengunjungController();
    $is_user_baru = $pengunjung_ctrl->addUser($ktp, $nama, $telepon); //gausah di cek dulu pengunjungnya uda ada ato belom. buang waktu.

    if(!$is_user_baru){
      //artinya perlu di update nama sama nomor teleponnya
      $pengunjung_ctrl->updateUser($ktp, $nama, $telepon);
    }
    
    $limit_ctrl = new LimitTiketController();
    $kuota = $limit_ctrl->get_kuota($tanggal)["sisa_tiket"];
    

    $reservasi_ctrl = new ReservasiController();
    if($reservasi_ctrl->masih_bisa_pesan($ktp, $tanggal, $jml) == false){
      //kalau usernya uda gabisa mesen lagi karena limit, ini karena user sebelumnya uda order reservasi juga, terus dia coba pesen reservasi lagi
      require_once "controller/services/view.php";
			return View::createPengunjungView("error_page.php", ["error_code"=>002]);
    }else{
      $update_tiket_result = $limit_ctrl->update_tiket($kuota, $tanggal, $jml);
      $add_reservasi_result = $reservasi_ctrl->add_reservasi($kuota, $jml, $ktp, $tanggal);
      if($update_tiket_result == false || $add_reservasi_result == false){
        require_once "controller/services/view.php";
        return View::createPengunjungView("error_page.php", ["error_code"=>003]);
      }
    }
    
    $result = $update_tiket_result && $add_reservasi_result;
    
    $kode = $reservasi_ctrl->create_unique_id($kuota, $tanggal);
    return View::createPengunjungView("pengunjung_post_booking.php", [
      "nama"=> $nama,
      "tanggal"=> $tanggal,
      "jml" => $jml,
      "kode" => $kode,
      "result" => $result //kalau true berarti berhasil diupdate, kalo false berarti gagal register nya
    ]);
  }

}
?>