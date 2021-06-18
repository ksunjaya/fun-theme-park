<?php
  require_once "services/view.php";
  require_once "services/mySQLDB.php";

  class AkunController{
    protected $db;

    public function __construct(){
      $this->db = new MySQLDB("hostname", "root", "", "fun_resort");
    }

    public function post_login(){
      $username = $this->db->escapeString($_POST["username"]);
      $password = $this->db->escapeString($_POST["password"]);
      
      
    }

    public function find_pemilik($username, $password){
      $query = 'SELECT COUNT(username) AS "jumlah"
                FROM pemilik
                WHERE username="'.$username.'" AND password="'.$password.'"';

      $query_result = $this->db->executeSelectQuery($query);

      if(count($query_result[0]["jumlah"]) > 0) return true;
      else return false;
    }

    public function find_karyawan($username, $password){

    }
  }
?>