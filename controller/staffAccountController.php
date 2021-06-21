<?php 
/*
Kelas ini digunakan untuk control panel administrator, dimana admin bisa liat, edit, dan delete.
Dependencies : mySQLDB.php, view.php, model/staff.php
*/
require_once "services/mySQLDB.php";
require_once "services/view.php";
require_once "model/staff.php";

class StaffAccountController{
	protected $db;

	public function __construct(){
		$this->db = new MySQLDB("localhost","root","","fun_resort");
	}

	public function count_all(){
		$query = 'SELECT COUNT(ktp) AS "count" FROM karyawan';
		$query_result = $this->db->executeSelectQuery($query);

		if($query == false) return false;
    	else 				return $query_result[0]['count'];
    
	}

	public function getAllStaff(){
		// $page *= MAX;
		$query = "SELECT * FROM karyawan ORDER BY karyawan.ktp";
		$query_result = $this->db->executeSelectQuery($query);
		$result = [];

		foreach ($query_result as $key => $value) {
			$result[] = new Staff($value['ktp'], $value['nama'], $value['username']);
		}
		return $result;
	}

	public function view_update_pass(){
		$username = $_POST['user'];
		return View::createAdminView('pemilik_update_staff_password.php', [
			"username" => $username
			]);
	}

	public function updatePass(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password = $this->db->escapeString($password);
		$query = "UPDATE karyawan SET password=PASSWORD('$password') WHERE username='$username'";
		$this->db->executeNonSelectQuery($query);
	}

	public function deletePass(){
		$username = $_POST['user'];
		if(isset($username)){
			$query = "DELETE FROM karyawan WHERE username='$username'";
			$this->db->executeNonSelectQuery($query);
		}
	}
}

 ?>