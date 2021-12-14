<?php

namespace authorization;

use authorization\Exceptions\InvalidUser;
use authorization\Exceptions\NotToken;
use Firebase\JWT\JWT;

class Auth
{
    private static $secret_key = 'S0ftd4t4';
    private static $encrypt = ['HS256'];


    public static function SignIn($data): string
    {
        $time = time();

        $token = array(
            'exp' => $time + (60 * 60),
            'aud' => self::Aud(),
            'data' => $data
        );
        $token = JWT::encode($token, self::$secret_key);
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['token'] = $token;
        return $token;
    }

    public static function Check($token)
    {
        if (empty($token)) {
            throw new NotToken();
        }

        $decode = JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        );

        if ($decode->aud !== self::Aud()) {
            throw new InvalidUser();
        }
    }

    public static function GetData($token)
    {
        return JWT::decode(
            $token,
            self::$secret_key,
            self::$encrypt
        )->data;
    }

    private static function Aud(): string
    {
        $aud = '';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $aud = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $aud = $_SERVER['REMOTE_ADDR'];
        }

        $aud .= @$_SERVER['HTTP_USER_AGENT'];
        $aud .= gethostname();

        return sha1($aud);
    }
    public static function isLogin(): bool
    {
        session_start();
        $response = true;
        try {
            if (empty($_SESSION['token'])) {
                $response = false;
            } else {
                self::Check($_SESSION['token']);
            }
        } catch (\Exception $ex) {
            $response = false;
        }

        return $response;
    }
    public static function getToken(): string
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        return $_SESSION['token'];
    }
    public static function getBearerToken()
    {

        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
}
