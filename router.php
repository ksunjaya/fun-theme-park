<?php
	$url = $_SERVER['REDIRECT_URL'];
	$baseURL = $_SERVER['REQUEST_URI']; 
	$baseURL = dirname($baseURL);
	if($_SERVER["REQUEST_METHOD"] == "GET"){
		switch($url){
			//=========USER============
			case $baseURL.'/home':
				require_once "controller/userController.php";
				$user_ctrl = new userController();
				echo $user_ctrl->show_home();
				break;
			case $baseURL.'/about':
				require_once "controller/userController.php";
				$user_ctrl = new userController();
				echo $user_ctrl->show_cari_tahu();
				break;
			//=========USER'S SERVICES==========
			case $baseURL.'/getkuota':
				require_once "controller/limitTiketController.php";
				$lt_ctrl = new LimitTiketController();
				echo $lt_ctrl->get_kuota_json();
				break;
			case $baseURL.'/getharga':
				require_once "controller/hargaTiketController.php";
				$ht_ctrl = new HargaTiketController();
				echo $ht_ctrl->_request_harga();
				break;
			//=========PRIVILEGES=========
			case $baseURL.'/login':
				require_once "controller/credentialController.php";
				$credential_ctrl = new CredentialController();
				if(isset($_GET["err"]) && $_GET["err"] == 1)
					echo $credential_ctrl->show_login(1);
				else 
					echo $credential_ctrl->show_login(0);
				break;
			case $baseURL.'/logout':
				require_once "controller/credentialController.php";
				$credential_ctrl = new CredentialController();
				$credential_ctrl->log_out();
				header("Location: login");
				break;
			//============ADMIN============
			case $baseURL.'/main':
				require_once "controller/adminController.php";
				$user_ctrl = new AdminController();
				echo $user_ctrl->show_main();
				break;
			case $baseURL.'/log-transaksi':
				require_once "controller/adminController.php";
				$user_ctrl = new AdminController();
				echo $user_ctrl->view_log();
				break;
			case $baseURL.'/staff-list':
				require_once "controller/adminController.php";
				$admin_ctrl = new AdminController();
				echo $admin_ctrl->view_staff_accounts();
				break;
			case $baseURL.'/add-staff':
				require_once "controller/services/view.php";
				echo View::createAdminView("coba.php", []);
				break;
			case $baseURL.'/tickets':
				require_once "controller/adminController.php";
				$user_ctrl = new AdminController();
				echo $user_ctrl->view_tiket();
				break;
			case $baseURL.'/cek-tiket':
				require_once "controller/limitTiketController.php";
				$limit_ctrl = new LimitTiketController();
				echo $limit_ctrl->contains();
				break;
			case $baseURL.'/add-ticket':
				require_once "controller/services/view.php";
				echo View::createAdminView("pemilik_set_tiket.php", []);
				break;
			case $baseURL.'/create-account':
				require_once "controller/services/view.php";
				echo View::createAdminView("pemilik_staff_create_account.php", []);
				break;
			//=======STAFF's PAGE ==========
			case $baseURL.'/staff':
				require_once "controller/staffTransaksiController.php";
				$staff_ctrl = new StaffController();
				echo $staff_ctrl->viewAll();
				break;
			case $baseURL.'/get-reservasi':
				require_once "controller/reservasiController.php";
				$reservasiCtrl = new ReservasiController();
				echo $reservasiCtrl->HTTP_GET_reservasi();
				break;
			case $baseURL.'/print-invoice':
				require_once 'controller/staffTransaksiController.php';
				$staff_ctrl = new StaffController();
				$staff_ctrl -> createPDF();
			//=========ERROR PAGE============
			case $baseURL.'/forbidden':
				require_once "controller/services/view.php";
				echo View::createPengunjungView("error_page.php", ["error_code"=>403]);
				break;
			case $baseURL.'/not-found':
				require_once "controller/services/view.php";
				echo View::createPengunjungView("error_page.php", ["error_code"=>404]);
				break;
			case $baseURL.'/limit-reached':
				require_once "controller/services/view.php";
				echo View::createPengunjungView("error_page.php", ["error_code"=>002]);
				break;
			default:
				header("Location: not-found");
				break;
		}
	}else if($_SERVER["REQUEST_METHOD"] == "POST"){
		switch($url){
			case $baseURL.'/confirmation':
				require_once "controller/userController.php";
				$user_ctrl = new userController();
				echo $user_ctrl->show_post_booking();
				break;
			case $baseURL.'/add-ticket':
				require_once "controller/adminController.php";
				$admin_ctrl = new AdminController();
				$admin_ctrl->createTicket();
				break;
			case $baseURL.'/login':
				require_once "controller/credentialController.php";
				$account_controller = new CredentialController();
				$account_controller->login();
				break;
			case $baseURL.'/update':
				require_once "controller/karyawanController.php";
				$karyawan_ctrl = new KaryawanController();
				echo $karyawan_ctrl->view_update_pass();
				break;
			case $baseURL.'/updatepass':
				require_once "controller/karyawanController.php";
				$karyawan_ctrl = new KaryawanController();
				echo $karyawan_ctrl->updatePass();
				header('Location: staff-list');
				break;
			case $baseURL.'/delete-staff':
				require_once "controller/karyawanController.php";
				$karyawan_ctrl = new KaryawanController();
				echo $karyawan_ctrl->deletePass();
				header('Location: staff-list');
				break;
			case $baseURL.'/add-staff':
				require_once "controller/karyawanController.php";
				$karyawan_ctrl = new KaryawanController();
				echo $karyawan_ctrl->add_staff();
				break;
			// print-pdf-log-transaksi
			case $baseURL.'/pdf-transaksi':
				require_once "controller/transaksiController.php";
				$transaksi_ctrl = new TransaksiController();
				$transaksi_ctrl->createPDF();
				break;
			//=============STAFF================
			case $baseURL.'/post-ticket':
				require_once "controller/transaksiController.php";
				$transaksi_ctrl = new TransaksiController();
				echo $transaksi_ctrl->_POST_AddTransaksi(true);
				break;
			default:
				header("Location: not-found");
				break;
		}
	}
?>