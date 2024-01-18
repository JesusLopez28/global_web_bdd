<?php

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
            echo "Error de conexión: " . $this->error;
            die();
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

$sql = "SELECT * FROM users WHERE id = 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Conexión exitosa.<br><br>";
    echo "ID: " . $row["ID"] . "<br>";
    echo "Name: " . $row["name"] . "<br>";
    echo "Last Name: " . $row["last_name"] . "<br>";
    echo "Email: " . $row["email"] . "<br>";
    echo "Phone: " . $row["phone"] . "<br>";
    echo "Password: " . $row["password"] . "<br>";
    echo "Role: " . $row["role"] . "<br>";
} else {
    echo "No se encontraron resultados.";
}

$conn->close();
