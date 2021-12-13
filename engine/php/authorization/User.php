<?php

namespace authorization;

class User
{

    private string $name;
    private string $password;

    public function __construct(string $name, string $password)
    {
        $this->name = $name;
        $this->password = $password;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function  password()
    {
        return $this->password;
    }
}
