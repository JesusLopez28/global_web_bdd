<?php

class User extends Crud
{
    public $conn;
    function __construct($conn)
    {
        $this->table = "users";
        $this->conn = $conn;
    }
}
