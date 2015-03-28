<?php

class RegId
{
	public $regid;
	public $code_section;
	
	function RegId($regid,$code_section)
    {
		$this->regid = $regid;
		$this->code_section=utf8_encode($code_section);
    }
}

