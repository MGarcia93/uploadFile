<?php

namespace authorization;

interface BaseAuth
{
    public function Login(string $user, string $password): User;
}
