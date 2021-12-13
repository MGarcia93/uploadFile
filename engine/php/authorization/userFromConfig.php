<?php

namespace authorization;

use authorization\Exceptions\UserIncorrect;

class userFromConfig implements BaseAuth
{
    public function Login(string $user, string $password): User
    {
        global $_CONFIG;
        if (!isset($_CONFIG['Users_upload']) || !in_array(["user" => $user, "password" => $password], $_CONFIG['Users_upload'])) {
            throw new UserIncorrect();
        }
        return new User($user, $password);;
    }
}
