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

    case 'user.register':
        $user = new User($conn);
        response($user->register($request->data));
        break;

    case 'user.getMenu':
        $crud = new Crud($conn, $request->object);
        response($crud->getMenu());
        break;

    case "user.getSesionData":
        $user = new User($conn);
        response($user->getSesionData());
        break;

    case 'object.order':
        $crud = new Crud($conn, $request->object);
        response($crud->order());
        break;

    case 'object.create':
        $crud = new Crud($conn, $request->object);
        response($crud->create($request->data));
        break;

    case 'object.delete':
        $crud = new Crud($conn, $request->object);
        response($crud->delete($request->where));
        break;

    case 'object.update':
        $crud = new Crud($conn, $request->object);
        response($crud->update($request->data, $request->where));
        break;

    case 'object.create':
        $crud = new Crud($conn, $request->object);
        response($crud->create($request->data));
        break;

    case 'object.getInfo':
        $crud = new Crud($conn, $request->object);
        response($crud->getInfo());
        break;

    case 'object.getRows':
        $crud = new Crud($conn, $request->object);
        response($crud->getData($request->fields, $request->where, $request->page, $request->order));
        break;

    case 'object.count':
        $crud = new Crud($conn, $request->object);
        response($crud->count($request->where));
        break;

    default:
        response(["status" => "BAD", "message" => "El endpoint que consultas no existe."]);
        break;
}
