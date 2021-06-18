<?php
  require_once "services/view.php";
  require_once "services/mySQLDB.php";

  class AccountController{
    protected $db;

    public function __construct(){
      $this->db = new MySQLDB("localhost", "root", "", "fun_resort");
    }

    public function log_out(){
      session_start();

      $_SESSION["nama"] = null;
      unset($_SESSION["nama"]);
      $_SESSION["role"] = null;
      unset($_SESSION["role"]);
      session_unset();

      session_destroy();
    }

    public function post_login(){
      $username = $this->db->escapeString($_POST["username"]);
      $password = $this->db->escapeString($_POST["password"]);
      
      //cobain dulu login atas nama admin
      $is_pemilik_found = $this->find_pemilik($username, $password);
      if($is_pemilik_found){
        $nama = $this->get_nama($username, "Pemilik");
        $this->start_session($nama, "admin");
        return 1;
      }else{
        //kita coba login atas nama karyawan
        $is_karyawan_found = $this->find_karyawan($username, $password);
        if($is_karyawan_found){
          $nama = $this->get_nama($username, "Karyawan");
          $this->start_session($nama, "staff");
          return 2;
        }else{
          return 0; //login gagal
        }
      }
 
    }

    private function start_session($name, $role){
      session_start();
      $_SESSION["name"] = $name;
      $_SESSION["role"] = $role;
    }

    public function find_pemilik($username, $password){
      $query = 'SELECT COUNT(username) AS "jumlah"
                FROM pemilik
                WHERE username="'.$username.'" AND password=PASSWORD("'.$password.'")';

      $query_result = $this->db->executeSelectQuery($query);

      if($query_result[0]["jumlah"] > 0) return true;
      else return false;
    }

    public function find_karyawan($username, $password){
      $query = 'SELECT COUNT(username) AS "jumlah"
                FROM karyawan
                WHERE username="'.$username.'" AND password=PASSWORD("'.$password.'")';

      $query_result = $this->db->executeSelectQuery($query);

      if($query_result[0]["jumlah"] > 0) return true;
      else return false;
    }

    private function get_nama($username, $table){
      $query = 'SELECT nama
                FROM '.$table.'
                WHERE username="'.$username.'"';
      $query_result = $this->db->executeSelectQuery($query);

      if(count($query_result) > 0) return $query_result[0]["nama"];
      else return false;
    }

    
  }
?>