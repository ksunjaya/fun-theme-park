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

	public function add_staff(){
		
	}
	//folder_name adalah username
	private function upload_file(){
		$folder_name = $this->db->escapeString($_POST["username"]);

		$upload_dir = dirname(__DIR__)."\\uploads\\";
		//kalau belum ada foldernya, harus dibikin dulu
		if(!file_exists($upload_dir.$folder_name)){
			mkdir($upload_dir.$folder_name, 0777, true);
		}

		if($_SERVER["REQUEST_METHOD"] == "POST"){
		  $result = array();
		  if($_FILES['upfile']['name'] != ""){
			if(substr($_FILES['upfile']['name'], -4, 4) == ".jpg" || substr($_FILES['upfile']['name'], -4, 4) == ".png"){
				$result["name"] = $_FILES['upfile']['name'];
				$result["temp_dir"] = $_FILES['upfile']['tmp_name'];

				$newname = $upload_dir.$folder_name.'\\'.$result["name"];
				if(move_uploaded_file($result["temp_dir"], $newname)){
			 		$result["result"] =  true;
					
				}else{
			 		$result["result"] = "error_copy";
				}
			}else $result["result"] = "format_error";
		  }else $result["result"] = "no_pic";
		}
		return json_encode($result);
	}


}

 ?>