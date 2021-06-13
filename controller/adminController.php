<?php
require_once "services/mySQLDB.php";
require_once "services/view_admin.php";
class adminController{
  protected $db;

  public function __construct()
  {
    $this->db = new mySQLDB("localhost", "root", "", "fun_resort");
  }

  public function show_login(){
    return View::createAdminView("login_page.php", []);
  }

}
?>