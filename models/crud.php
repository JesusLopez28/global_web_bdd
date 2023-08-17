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

    function getInfo()
    {
        $table = $this->table;
        $sql = "show full columns from $table;";
        if (DEBUG) echo $sql;
        $result = $this->conn->query($sql);
        $data = [];
        $primary = "[NO_PRIMARY]";
        while ($row = $result->fetch_assoc()) {
            if ($row["Key"] == "PRI") $primary = $row["Field"];
            $comments = json_decode($row["Comment"]);
            $r = [
                "field" => $row["Field"],
                "label" => $comments->label
            ];
            array_push($data, $r);
        }
        return [
            "primary" => $primary,
            "data" => $data
        ];
    }

    function getData($fields = "*", $where = "true", $page = 0, $order = "")
    {
        $table = $this->table;
        $data = [];
        $rows = ROWS_PER_PAGE;
        if ($table != "address_book") {
        }
        $startIndex = ($page) * $rows;
        $sql = "SELECT $fields FROM $table WHERE $where $order LIMIT $startIndex, $rows";
        if (DEBUG) echo "\n$sql\n";
        #die();
        $result = $this->conn->query($sql);
        if ($result === FALSE) {
            if (DEBUG) {
                echo "\n\n→Error conn: " . $this->conn->error . "\n\n";
            }
        }
        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
        return $data;
    }

    function count($where = "true")
    {
        $table = $this->table;
        $data = [];
        $sql = "select count(*) as total_rows from $table where $where";
        $result = $this->conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
        return [
            "status" => "OK",
            "total_rows" => $data[0]["total_rows"],
            "total_pages" => ceil($data[0]["total_rows"] / ROWS_PER_PAGE)
        ];
    }


    function getIndexProducts()
    {
        $table = 'products';
    }

    function getIndexCategories()
    {
        $table = 'categories';
    }
}
