<?php

namespace Src\users\domain;

class User
{
    public $id;
    public $name;
    public $username;
    public $password;

    function __construct(
        $id,
        $name,
        $username,
        $password
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
    }


}
