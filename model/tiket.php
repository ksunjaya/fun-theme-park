<?php

class Tiket{
	protected $tanggal;
	protected $limit;
	protected $maxOrder;
  	protected $sisa;
  	protected $harga;

	public function __construct($tanggal, $limit, $maxOrder, $sisa, $harga){
		$this->tanggal = $tanggal;
		$this->limit = $limit;
		$this->maxOrder = $maxOrder;
    	$this->sisa = $sisa;
    	$this->harga = $harga;
	}

	public function getRawTanggal(){
		return $this->tanggal;
	}

	public function getTanggal(){
		$formatted = strtotime($this->tanggal);
		$formatted = date('j F Y', $formatted);
		return $formatted;
	}

	public function getLimit(){
		return $this->limit;
	}

	public function getMaxOrder(){
		return $this->maxOrder;
	}

  	public function getSisa(){
		return $this->sisa;
	}

 	public function getHarga(){
		return 'Rp. '.$this->format_harga($this->harga);
	}

	private function format_harga($harga){

		// revisi
		$result = "";
		$sisa = (strlen($harga) % 3);
		if (strlen($harga)%3 == 0 && strlen($harga) > 3){
			$sisa = 3;
		}
		$result = substr($harga, 0, $sisa);
		for ($i = $sisa; $i < strlen($harga); $i+=3) {
			$result.=".".substr ($harga, $i, 3);
		}

		// $result = "";
		// for($i = strlen($harga)-3; $i >= 0; $i -= 3){
		// $result = substr($harga, 0, $i).'.'.substr($harga, $i, strlen($harga));
		// }
		return $result;
  	}
}

?>