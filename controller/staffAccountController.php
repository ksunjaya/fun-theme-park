<?php 
require_once "services/mysqlDB.php";
require_once "services/view.php";
require_once "model/staff.php";

class StaffAccountController{
	protected $db;

	public function __construct(){
		$this->db = new MySQLDB("localhost","root","","fun_resort");
	}

	public function view_account(){
		$result = $this->getAllStaff();
		return View::createAdminView('pemilik_staff_account.php',
			[
				"result"=> $result
			]);
	}

	public function getAllStaff(){
		$query = "SELECT * FROM karyawan ORDER BY karyawan.ktp";
		$query_result = $this->db->executeSelectQuery($query);
		$result = [];

		foreach ($query_result as $key => $value) {
			$result[] = new Staff($value['ktp'], $value['nama'], $value['username']);
		}
		return $result;
	}

    public function view_update_pass(){
		return View::createView('pemilik_update_staff_password.php', []);
	}
}

 ?>