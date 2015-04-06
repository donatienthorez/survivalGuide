<?php

class Member
{
    public $username;
    public $mail;
    public $code_section;
    public $role;

    function Member($username, $mail, $code_section, $role)
    {
        $this->username = $username;
        $this->mail = $mail;
        $this->code_section = $code_section;
        $this->role = $role;
    }
}
