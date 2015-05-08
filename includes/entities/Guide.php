<?php

class Guide{

    public $code_section;
    public $status;

    const STATUS_ON = 'ON';
    const STATUS_OFF = 'OFF';

    public function __toString()
    {
        return $this->code_section;
    }

    function Guide($code_section,$status = self::STATUS_OFF)
    {

        $this->code_section=$code_section;
        $this->status = $status;
    }

    public function activateGuide()
    {
        $this->status = self::STATUS_ON;
    }

    public function desactivateGuide()
    {
        $this->status = self::STATUS_OFF;
    }

    public function isActivated()
    {
        return $this->status==self::STATUS_ON;
    }
}
