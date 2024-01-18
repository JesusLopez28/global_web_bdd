<?php

class Authentication extends Crud
{
    public $conn;
    function __construct($conn)
    {
        $this->table = "auth_token";
        $this->conn = $conn;
    }
    function deleteOldTokens($email)
    {
        $sql = "delete from auth_token where user_id = (select id from users where email = '$email') and creation_date < NOW() - INTERVAL 1 DAY";
        if (DEBUG) echo $sql;
        $this->conn->query($sql);
    }
    function createToken($email)
    {
        $this->deleteOldTokens($email);
        $token = $this->generateRandomString();
        $sql = "select id from users where email = '$email'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        $id = $row["id"];
        $this->create(["user_id" => $id, "token" => $token]);
        return $token;
    }
    function validateToken($token)
    {
        $sql = "select count(*) from auth_token where token = '$token'";
        if (DEBUG) echo $sql;
        $n = $this->conn->query($sql)->fetch_assoc()["count(*)"];
        return $n;
    }
    function getUserDataByToken($token)
    {
        $sql = "SELECT u.id, u.email, u.name, u.role 
        FROM users u
        JOIN auth_token a ON u.id = a.user_id
        WHERE a.token = '$token';";
        if (DEBUG) echo $sql;
        $n = $this->conn->query($sql)->fetch_assoc();
        return $n;
    }
    function generateRandomString($length = 60)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
