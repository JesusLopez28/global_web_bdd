<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json');
define("DEBUG", isset($_GET["debug"]));
define("ROWS_PER_PAGE", 15);
error_reporting(0);
if (DEBUG) error_reporting(E_ALL);
setlocale(LC_ALL, "es_ES");
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, 'es_ES.UTF-8');

include 'core.php';
switch ($endpoint) {

    case 'user.login':
        $user = new User($conn);
        response($user->login($request->email, $request->password));
        break;

    default:
        response(["status" => "BAD", "message" => "El endpoint que consultas no existe."]);
        break;
}
