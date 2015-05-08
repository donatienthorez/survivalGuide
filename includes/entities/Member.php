<?php

class Member
{
    public $username;
    public $mail;
    public $code_section;
    public $role;

    const ROLE_MEMBER = 'member';
    const ROLE_ADMIN = 'admin';


    function Member($username, $mail, $code_section, $role)
    {
        $this->username = $username;
        $this->mail = $mail;
        $this->code_section = $code_section;
        $this->role = $role;
    }
}
