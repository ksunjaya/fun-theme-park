<?php
//TODO LIST
//2) Pindahin session control diluar layout, biar bisa nampilin nama nya di layout. Alternatif urus di view admin
	$url = $_SERVER['REDIRECT_URL'];
	$baseURL = $_SERVER['REQUEST_URI']; 
	$baseURL = dirname($baseURL);

	if($_SERVER["REQUEST_METHOD"] == "GET"){
		switch($url){
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
			case $baseURL.'/main':
				require_once "controller/adminController.php";
				$user_ctrl = new AdminController();
				echo $user_ctrl->show_main();
				break;
			case $baseURL.'/create':
				require_once "controller/adminController.php";
				$user_ctrl = new AdminController();
				echo $user_ctrl->show_create();
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
			case $baseURL.'/staffaccount':
				require_once "controller/staffAccountController.php";
				$staffCtrl = new StaffAccountController();
				echo $staffCtrl->view_account();
				break;
			case $baseURL.'/not-found':
				echo '404 Not Found';
				break;
			default:
				echo '404 Not Found';
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
				header('Location: updatepass');
				break;
			default:
				echo 'Page not found';
		}
	}
?>