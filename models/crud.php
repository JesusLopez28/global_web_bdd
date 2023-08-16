<?php

class Crud
{
    public $table;
    public $conn;
    public static $privileges_matrix, $field_privileges;

    function __construct($conn, $table)
    {
        $this->table = $table;
        $this->conn = $conn;
    }

    function create($data)
    {
        $data = (array) $data;
        $table = $this->table;
        $fields = "";
        $values = "";
        foreach ($data as $key => $value) {
            if (empty($value)) {
                return ["status" => "BAD", "message" => "Verifique que los datos no estén vacíos"];
            }
            $fields .= "$key, ";
            $values .= "\"$value\", ";
        }
        $fields = rtrim($fields, ", ");
        $values = rtrim($values, ", ");
        $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        try {
            if ($this->conn->query($sql) !== FALSE) {
                return ["status" => "OK", "message" => "$table creado correctamente"];
            } else {
                return ["status" => "BAD", "message" => "No se puede crear $table -> {$this->conn->error}"];
            }
        } catch (mysqli_sql_exception $ex) {
            if (strpos($ex->getMessage(), "Duplicate entry") !== FALSE) {
                return ["status" => "BAD", "message" => "Registro duplicado"];
            } else {
                return ["status" => "BAD", "message" => "Error en la base de datos: " . $ex->getMessage()];
            }
        }
    }

    function delete($where = "false")
    {
        $table = $this->table;
        $sql = "delete from $table where $where";
        if ($this->conn->query($sql) !== FALSE) {
            return ["status" => "OK", "message" => "$table eliminado con éxito."];
        } else {
            $error = $this->conn->error;
            return ["status" => "BAD", "message" => "No se puede eliminar $table -> $error"];
        }
    }

    function update($data, $where = "false")
    {
        $data = (array) $data;
        $table = $this->table;
        $fields = "";
        foreach ($data as $key => $value) {
            if (!empty($value)) {
                $fields .= "$key = \"$value\", ";
            }
        }
        if (empty($fields)) {
            return ["status" => "BAD", "message" => "Verifique que los datos no estén vacíos"];
        }

        $fields = rtrim($fields, ", ");
        $sql = "UPDATE $table SET $fields WHERE $where";
        if (DEBUG) {
            echo $sql;
        }
        if ($this->conn->query($sql) !== FALSE) {
            return ["status" => "OK", "message" => "$table actualizado con éxito."];
        } else {
            $error = $this->conn->error;
            return ["status" => "BAD", "message" => "No fue posible actualizar $table -> $error"];
        }
    }

    function getMenu()
    {
        $menu = [];

        if (USER["role"] == "cliente") {
            array_push($menu, [
                "img" => "../assets/icons/home.png",
                "text" => "Home",
                "location" => "dashboard.php",
            ]);

            array_push($menu, [
                "img" => "../assets/icons/carrito.png",
                "text" => "Carrito",
                "location" => "shoppingCar.php",
            ]);

            array_push($menu, [
                "img" => "../assets/icons/pedidos.png",
                "text" => "Pedidos",
                "location" => "orders.php",
            ]);
        }


        if (USER["role"] == "administrador") {
            array_push($menu, [
                "img" => "../assets/icons/home.png",
                "text" => "Home",
                "location" => "admin.php",
            ]);

            array_push($menu, [
                "img" => "../assets/icons/gUser.png",
                "text" => "Gestionar Usuarios",
                "location" => "manageUsers.php",
            ]);

            array_push($menu, [
                "img" => "../assets/icons/gProducts.png",
                "text" => "Gestionar Productos",
                "location" => "manageProducts.php",
            ]);
        }

        array_push($menu, [
            "img" => "../assets/icons/cerrar.png",
            "text" => "Salir",
            "location" => "#",
        ]);

        return $menu;
    }
}
