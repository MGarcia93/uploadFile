<?php

namespace authorization;

class Login
{
    private BaseAuth $auth;
    public function __construct(baseAuth $auth)
    {
        $this->auth = $auth;
    }

    public function __invoke($user, $password): User
    {
        $user = $this->auth->Login($user, $password);

        return $user;
    }
}
