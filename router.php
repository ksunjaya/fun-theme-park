<?php
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
				echo $ht_ctrl->get_harga();
				break;
			default:
				echo 'Page not found';
		}
	}else if($_SERVER["REQUEST_METHOD"] == "POST"){
		switch($url){
			case $baseURL.'/confirmation':
				require_once "controller/userController.php";
				$user_ctrl = new userController();
				echo $user_ctrl->show_post_booking();
				break;
			default:
				echo 'Page not found';
		}
	}
?>