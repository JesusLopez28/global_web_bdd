<?php
setlocale(LC_ALL, "es_ES");
date_default_timezone_set("America/Mexico_City");
setlocale(LC_TIME, 'es_ES.UTF-8');

class Connector
{
    public $conn;
    public $error;

    function __construct()
    {
        $servername = "10.0.0.5";
        $username = "ansus";
        $dbname = "ansus";
        $password = "1234";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            $this->error = $conn->connect_error;
            die("Error de conexión: " . $this->error);
        }

        $this->conn = $conn;
    }

    function query($sql)
    {
        $result = $this->conn->query($sql);
        if ($result === FALSE) {
            $this->error = $this->conn->error;
        }

        return $result;
    }

    function close()
    {
        $this->conn->close();
    }
}
$conn = new Connector();
include "../models/crud.php";
$files = ["authentication.php", "crud.php", "user.php", "product.php"];
foreach ($files as $file) {
    if ($file != "." && $file != ".." && $file != "crud.php") {
        include "../models/" . $file;
    }
}

function response($data)
{
    echo json_encode($data, JSON_PRETTY_PRINT);
    die();
}

function query_params_to_array($query_params)
{
    $query_array = array();
    parse_str($query_params, $query_array);
    return (object)$query_array;
}

$request_original = file_get_contents("php://input");
$request = json_decode($request_original);
if ($request == NULL) {
    if (preg_match('/^.+=.+$/', $request_original)) {
        $request = query_params_to_array($request_original);
        // print_r($request);
    } else {
        response(["status" => "BAD", "message" => "Por favor envíe un request válido."]);
    }
}

$endpoint = "user.login";
if (isset($_GET["endpoint"])) {
    $endpoint = $_GET["endpoint"];
}
$open_endpoints = ["user.login", "user.register"];

if (!in_array($endpoint, $open_endpoints)) {
    $authentication = new Authentication($conn);
    $headers = apache_request_headers();
    $token = explode("Bearer ", $headers['Authorization'])[1];
    if (!isset($token)) {
        response([
            "status" => "NO_AUTH",
            "message" => "Error de autenticación"
        ]);
    } else if (!$authentication->validateToken($token)) {
        response([
            "status" => "NO_AUTH",
            "message" => "Error de autenticación"
        ]);
    }
    define("USER", $authentication->getUserDataByToken($token));
}
