<?php

class Authentication extends Crud
{
    public $conn;
    function __construct($conn)
    {
        $this->table = "auth_token";
        $this->conn = $conn;
    }
    function deleteOldTokens($id)
    {
        $sql = "delete from auth_token where user_id = '$id' and creation_date < NOW() - INTERVAL 1 DAY";
        $this->conn->query($sql);
    }
    function createToken($id)
    {
        $this->deleteOldTokens($id);
        $token = $this->generateRandomString();
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
        $sql = "select id, email, name, role from users where id = (select user_id from auth_token where token = '$token')";
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
