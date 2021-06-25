<?php 
/*
Kelas ini digunakan untuk control panel administrator, dimana admin bisa liat, edit, dan delete.
Dependencies : mySQLDB.php, view.php, model/staff.php
*/

require_once "services/mySQLDB.php";
require_once "services/view.php";
require_once "model/staff.php";

class KaryawanController{
	protected $db;
	private $seperator;

	public function __construct(){
		$this->db = new MySQLDB("localhost","root","","fun_resort");
		(PHP_OS == "Windows" || PHP_OS == "WIN_NT")? $this->seperator = "\\" : $this->seperator = "/";
	}

	public function count_all(){
		$query = 'SELECT COUNT(ktp) AS "count" FROM karyawan';
		$query_result = $this->db->executeSelectQuery($query);

		if($query == false) return false;
    	else 				return $query_result[0]['count'];
    
	}

	public function getAllStaff($page, $count){
		$page *= MAX;
		$query = 'SELECT * FROM karyawan ORDER BY karyawan.ktp LIMIT '.$page.','.$count;
		$query_result = $this->db->executeSelectQuery($query);
		$result = [];

		foreach ($query_result as $key => $value) {
			$result[] = new Staff($value['ktp'], $value['nama'], $value['username'], $value['photo_location']);
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

			$file = dirname(__DIR__).$this->seperator."uploads".$this->seperator.$username;
			self::deleteDir($file);
		}
	}

	public function add_staff(){
		//init
		$ktp = $this->db->escapeString($_POST["ktp"]);
		$nama = $this->db->escapeString($_POST["fullname"]);
		$username = $this->db->escapeString($_POST["username"]);
		$password = $this->db->escapeString($_POST["password"]);

		//coba upload foto
		$result = $this->upload_file($username); //folder_name adalah username

		//kalau berhasil upload foto
		if($result['result'] == true){
			$file_name = $this->db->escapeString($result["file_name"]);
			$query = 'INSERT INTO karyawan VALUES ("'.$ktp.'", "'.$nama.'", "'.$username.'", PASSWORD("'.$password.'"), "'.$file_name.'")';
			$query_result = $this->db->executeNonSelectQuery($query);

			$result['result'] = $query_result;
		}
		
		return json_encode($result);
	}

	private function upload_file($folder_name){
		//$folder_name = $this->db->escapeString($_POST["username"]);

		$upload_dir = dirname(__DIR__).$this->seperator."uploads".$this->seperator;
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
					$result["file_name"] = $newname;
				}else{
			 		$result["result"] = "error_copy";
				}
			}else $result["result"] = "format_error";
		  }else $result["result"] = "no_pic";
		}
		return $result;
	}

	//buat urusan login
	public function is_valid($username, $password){
		$query = 'SELECT COUNT(username) AS "jumlah"
              FROM karyawan
              WHERE username="'.$username.'" AND password=PASSWORD("'.$password.'")';

    $query_result = $this->db->executeSelectQuery($query);

    if($query_result[0]["jumlah"] > 0) return true;
    else return false;
	}

	public function get_nama($username){
    $query = 'SELECT nama
              FROM karyawan
              WHERE username="'.$username.'"';
    $query_result = $this->db->executeSelectQuery($query);

    if(count($query_result) > 0) return $query_result[0]['nama'];
    else return "Error : username tidak ditemukan!";
  }

	//UTILITES
	private static function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}
}

 ?>