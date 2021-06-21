<?php

class Log{
	protected $date;
	protected $idBooking;
	protected $totalTicket;
    protected $totalPrice;

	public function __construct($date, $idBooking, $totalTicket, $totalPrice){
		$this->date = $date;
		$this->idBooking = $idBooking;
		$this->totalTicket = $totalTicket;
        $this->totalPrice = $totalPrice;
	}

	public function getRawDate(){
		return $this->tanggal;
	}

	public function getDate(){
		$formatted = strtotime($this->tanggal);
		$formatted = date('j F Y', $formatted);
		return $formatted;
	}

	public function getIdBooking(){
		return $this->idBooking;
	}

	public function getTotalTicket(){
		return $this->totalTicket;
	}

    public function getTotalPrice(){
            return $this->totalPrice;
	}
}

?>