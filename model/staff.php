<?php

class Staff{
	protected $ktp;
	protected $nama;
	protected $username;

	public function __construct($ktp, $nama, $username){
		$this->ktp = $ktp;
		$this->nama = $nama;
		$this->username = $username;
	}

	public function getKtp(){
		return $this->ktp;
	}

	public function getNama(){
		return $this->nama;
	}

	public function getUsername(){
		return $this->username;
	}

}

?>