<?php

class Pushes
{
	public $subject;
	public $message;
	public $date;
	public $code_section;

	function Pushes($subject, $message, $code_section, $date)
    {
		$this->subject=$subject;
		$this->message=$message;
		$this->date=$date;
		$this->code_section=$code_section;
    }
}
