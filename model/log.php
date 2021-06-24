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
		return $this->date;
	}

	public function getDate(){
		$formatted = strtotime($this->date);
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

	public function getFormattedPrice () {
		$sum = $this->totalPrice;
		$totalIncome = "";
		$sisa = (strlen($sum) % 3);
		if (strlen($sum)%3 == 0 && strlen($sum) > 3){
		$sisa = 3;
		}
		$totalIncome = substr($sum, 0, $sisa);
		for ($i = $sisa; $i < strlen($sum); $i+=3) {
		$totalIncome.=".".substr ($sum, $i, 3);
		}
		return $totalIncome;
	}
}

?>