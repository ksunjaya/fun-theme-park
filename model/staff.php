<?php

class Staff{
	protected $ktp;
	protected $nama;
	protected $username;
	protected $photoLocation;

	public function __construct($ktp, $nama, $username, $photoLocation){
		$this->ktp = $ktp;
		$this->nama = $nama;
		$this->username = $username;
		$this->photoLocation = $photoLocation;
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

	public function getPhotoLocation(){
		return $this->photoLocation;
	}
}

?>