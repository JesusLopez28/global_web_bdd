<?php

class Product
{
    public $conn;
    function __construct($conn)
    {
        $this->conn = $conn;
    }
}
