<?php
require_once "services/mySQLDB.php";
require_once "services/view.php";
require_once "reservasiController.php";
require_once "pengunjungController.php";

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
    $kuota = $this->db->escapeString($_POST['kuota']);
    
    $pengunjung_ctrl = new PengunjungController();
    $pengunjung_ctrl->addUser($ktp, $nama, $telepon); //gausah di cek dulu pengunjungnya uda ada ato belom. buang waktu.

    $reservasi_ctrl = new ReservasiController();
    $reservasi_ctrl->add_reservasi($kuota, $jml, $ktp, $tanggal);
    $kode = $reservasi_ctrl->create_unique_id($kuota, $tanggal);

    return View::createPengunjungView("pengunjung_post_booking.php", [
      "nama"=> $nama,
      "tanggal"=> $tanggal,
      "jml" => $jml,
      "kode" => $kode
    ]);
  }

}
?>