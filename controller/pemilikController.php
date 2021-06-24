<?php
require_once "services/mySQLDB.php";
require_once "services/view.php";

class PemilikController{
  protected $db;

  public function __construct(){
   $this->db = new MySQLDB("localhost", "root", "", "fun_resort");
  }

  public function is_valid($username, $password){
    $query = 'SELECT COUNT(username) AS "jumlah"
              FROM pemilik
              WHERE username="'.$username.'" AND password=PASSWORD("'.$password.'")';

    $query_result = $this->db->executeSelectQuery($query);

    if($query_result[0]["jumlah"] > 0) return true;
    else return false;
  }

  public function get_nama($username){
    $query = 'SELECT nama
              FROM pemilik
              WHERE username="'.$username.'"';
    $query_result = $this->db->executeSelectQuery($query);

    return $query_result[0]['nama'];
  }
}
?>