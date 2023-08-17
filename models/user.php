<?php

class User extends Crud
{
    public $conn;
    function __construct($conn)
    {
        $this->table = "users";
        $this->conn = $conn;
    }

    function login($email, $password)
    {
        $result = $this->conn->query("select * from users where email = '$email' and password = '$password'");
        $r = [];
        if ($result == FALSE) {
            echo "\n\n→" . $this->conn->error . "\n";
        }
        while ($row = $result->fetch_assoc()) {
            array_push($r, $row);
        }
        if (sizeof($r) > 0) {
            $authentication = new Authentication($this->conn);
            $token = $authentication->createToken($email);
            return [
                "code" => "OK",
                "message" => "Autenticación correcta.",
                "token" => "$token"
            ];
        } else {
            return [
                "code" => "BAD",
                "message" => "Error de autenticación."
            ];
        }
    }

    function register($data)
    {
        $object = new Crud($this->conn, $this->table);
        $result = $object->create($data);
        return $result;
    }

    function getSesionData()
    {
        return [
            "code" => "OK",
            "data" =>
            [
                "name" => "" . USER["name"] . "",
                "role" => "" . USER["role"] . ""
            ]
        ];
    }
}
