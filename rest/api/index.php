<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/services/ItemsService.php';
require_once __DIR__.'/services/BidsService.php';
require_once __DIR__.'/services/UserService.php';
require_once __DIR__.'/dao/UserDao.class.php';

Flight::register('userDao', 'UserDao');
Flight::register('itemsDao', 'ItemsDao');
Flight::register('bidsDao', 'BidsDao');

Flight::map('error', function (Exception $ex) {
    // Handle error
    Flight::json(['message' => $ex->getMessage()], 500);
});

/* utility function for reading query parameters from URL */
Flight::map('query', function ($name, $default_value = null) {
    $request = Flight::request();
    $query_param = @$request->query->getData()[$name];
    $query_param = $query_param ? $query_param : $default_value;
    return urldecode($query_param);
});

// middleware method for login


/* REST API documentation endpoint */
Flight::route('/*', function () {
    //return TRUE;
    //perform JWT decode
    $path = Flight::request()->url;
    if ($path == '/login' || $path == '/docs.json' || $path == '/register') {
        return true;
    } // exclude login route from middleware

    $headers = getallheaders();
    if (@!$headers['Authorization']) {
        Flight::json(["message" => "Authorization is missing"], 403);
        return false;
    } else {
        try {
            $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
            Flight::set('user', $decoded);
            return true;
        } catch (\Exception $e) {
            Flight::json(["message" => "Authorization token is not valid"], 403);
            return false;
        }
    }
});
Flight::route('GET /docs.json', function () {
    $openapi = \OpenApi\Generator::scan(['routes']);
    header('Content-Type: application/json');
    echo $openapi->toJson();
});

require_once __DIR__.'/routes/UserRoutes.php';
require_once __DIR__.'/routes/ItemsRoutes.php';
require_once __DIR__.'/routes/BidsRoutes.php';

Flight::start();
?>
