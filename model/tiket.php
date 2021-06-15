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
		return $this->harga;
	}
}

?>