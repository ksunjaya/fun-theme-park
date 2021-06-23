<?php
require_once "services/mySQLDB.php";
require_once "services/view.php";
require_once "pemilikController.php";
require_once "karyawanController.php";

class CredentialController{
  protected $db;
  private $pemilik_controller, $karyawan_controller;

  public function __construct(){
    $this->db = new MySQLDB("localhost", "root", "", "fun_resort");
    $this->pemilik_controller = new PemilikController();
    $this->karyawan_controller = new KaryawanController();
  }

  //==GET==
  public function show_login($err = 0){
    session_start();
    if(!isset($_SESSION["role"])) return View::createLoginView("login_page.php", $err); //berarti belom login, tunjukkin halaman login
    else if($_SESSION["role"] == "admin") header("Location: main"); //return View::createAdminView("pemilik_main.php", []);
    else if($_SESSION["role"] == "staff") header("Location: staff"); //return View::createStaffView("transaksi_staff.php", []);
  }

  //==POST==
  public function login(){
    $username = $this->db->escapeString($_POST["username"]);
    $password = $this->db->escapeString($_POST["password"]);

    //coba dulu login sebagai admin
    $result = $this->pemilik_controller->is_valid($username, $password);
    if($result == true){
      session_start();
      $_SESSION["name"] = $this->pemilik_controller->get_nama($username);
      $_SESSION["role"] = "admin";
      header("Location: main");
    }else{
      //kalau gagal, coba login sebagai staff
      $result = $this->karyawan_controller->is_valid($username, $password);
      if($result == true){
        session_start();
        $_SESSION["name"] = $this->karyawan_controller->get_nama($username);
        $_SESSION["role"] = "staff";
        header("Location: staff");
      }else{
        //berarti gagal
        header("Location: login?err=1"); 
      }
    }
  }

  public function log_out(){
    session_start();

    $_SESSION["name"] = null;
    unset($_SESSION["name"]);
    $_SESSION["role"] = null;
    unset($_SESSION["role"]);
    session_unset();

    session_destroy();
  }

  //returns none, admin, and staff
  public static function get_credential(){
    session_start();
    if(!isset($_SESSION["role"])) return "none";
    else return $_SESSION["role"];
  }

  public static function get_nama(){
    @session_start();
    return $_SESSION["name"];
  }
}
?>