<?php

namespace api\auth;

require_once "../../initialize.php";
require_once "../../Engine/php/vendor/autoload.php";

use api\Api;
use Exceptions\Handle;
use authorization\Auth;
use authorization\Login;
use Exceptions\NotParam;
use authorization\userFromConfig;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

if (empty($_POST)) {
    $_POST = json_decode(file_get_contents('php://input'), true);
}

class  page extends Api
{

    private string $user;
    private string $password;


    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function __invoke()
    {
        try {
            $Login = new Login(new userFromConfig());
            $user = $Login($this->user, $this->password);
            $token = Auth::SignIn(["user" => $user->name()]);
            $this->response(["Token" => $token], 200);
        } catch (ExpiredException $ex) {
            throw new Handle($ex->getMessage(), "tiempo de vida del token sobrepasado pida uno nuevo", 401);
        } catch (SignatureInvalidException $ex) {
            throw new Handle($ex->getMessage(), "token invalido", 400);
        } catch (\Exception $ex) {
            throw new Handle("ERROR", $ex->getMessage(), 400);
        }
    }
}
try {

    if (empty($_POST) || empty($_POST['user']) || empty($_POST['password'])) {
        throw new NotParam(401);
    }
    $page = new page($_POST['user'], $_POST['password']);
    $page();
} catch (\Exception $ex) {
    http_response_code(500);
    exit();
}
