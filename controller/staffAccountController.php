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

		// //buat urusin pagination
		// $last_page = ($this->count_all()) / MAX;
		// $page = 0;    //by default akan ke halaman 1
		// if(isset($_GET["page"])) $page = $_GET["page"];
		// //fetch
		// $result = $this->getAllStaff($page, MAX);
		// return View::createAdminView('pemilik_staff_account.php',[
		// 	"result"=> $result,
		//   	"page"=> $page,
		//   	"last_page"=>$last_page
		// ]);
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

	// public function count_all(){
	// 	$query = 'SELECT COUNT(ktp) AS "count" FROM karyawan';
	// 	$query_result = $this->db->executeSelectQuery($query);
	
	// 	if($query == false) return false;
	// 	else{
	// 	  return $query_result[0]['count'];
	// 	}
	// }

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

	// public function view_create_account(){
	// 	return View::createAdminView('pemilik_staff_create_account.php', []);
	// }
}

 ?>