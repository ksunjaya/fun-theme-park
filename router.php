<?php
	
	$url = $_SERVER['REDIRECT_URL'];
	$baseURL = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 

	if($_SERVER["REQUEST_METHOD"] == "GET"){
		switch($url){
			case $baseURL.'/home':
				break;
			default:
				echo 'Page not found';
		}
	}else if($_SERVER["REQUEST_METHOD"] == "POST"){
		
	}
?>