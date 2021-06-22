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
			//=========SERVICES==========
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
				require_once "controller/adminController.php";
				$user_ctrl = new AdminController();
				echo $user_ctrl->show_login();
				break;
			case $baseURL.'/logout':
				require_once "controller/accountController.php";
				$account_controller = new AccountController();
				$account_controller->log_out();
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
			//=========ERROR PAGE============
			case $baseURL.'/forbidden':
				require_once "controller/services/view.php";
				echo View::createPengunjungView("error_page.php", ["error_code"=>403]);
				break;
			case $baseURL.'/not-found':
				require_once "controller/services/view.php";
				echo View::createPengunjungView("error_page.php", ["error_code"=>404]);
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
			case $baseURL.'/log-transaksi-filter':
				require_once "controller/adminController.php";
				$admin_ctrl = new AdminController();
				echo $admin_ctrl->view_log();
				break;
			case $baseURL.'/login':
				require_once "controller/accountController.php";
				$account_controller = new AccountController();
				$status = $account_controller->post_login();
				if($status == 0){
					header("Location: login?status=failed");
				}else if($status == 1){
					header("Location: main"); //halaman admin;
				}else{
					header("Location: staff"); //halaman staff;
				}
			case $baseURL.'/update':
				require_once "controller/staffAccountController.php";
				$staffCtrl = new StaffAccountController();
				echo $staffCtrl->view_update_pass();
				break;
			case $baseURL.'/updatepass':
				require_once "controller/staffAccountController.php";
				$staffCtrl = new StaffAccountController();
				echo $staffCtrl->updatePass();
				header('Location: staff-list');
				break;
			case $baseURL.'/delete':
				require_once "controller/staffAccountController.php";
				$staffCtrl = new StaffAccountController();
				echo $staffCtrl->deletePass();
				header('Location: staff-list');
				break;
			case $baseURL.'/add-staff':
				require_once "controller/staffAccountController.php";
				$staffCtrl = new StaffAccountController();
				echo $staffCtrl->add_staff();
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