<?php

class Connector
{
    public $conn;
    public $error;

    function __construct()
    {
        $servername = "127.0.0.1";
        $username = "root";
        $dbname = "arsus";
        $password = "";

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
