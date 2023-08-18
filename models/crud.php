<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require '../fpdf/WriteTag.php';
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
            $comments = $row["Comment"];
            $r = [
                "field" => $row["Field"],
                "label" => $comments
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

    function order()
    {
        $userId = USER["id"];
        $email = USER["email"];
        $name = USER["name"];

        try {
            $cartQuery = "SELECT * FROM shopping_cart WHERE user_id = $userId";
            $cartResult = $this->conn->query($cartQuery);
            if (DEBUG) echo "\n$cartQuery\n";
            if (!$cartResult) {
                throw new Exception("Error al obtener el carrito");
            }

            $total = 0;
            while ($cartItem = $cartResult->fetch_assoc()) {
                $total += $cartItem['subtotal'];
            }

            $orderInsertQuery = "INSERT INTO orders (user_id, total) VALUES ($userId, $total)";
            $orderInsertResult = $this->conn->query($orderInsertQuery);
            if (DEBUG) echo "\n$orderInsertQuery\n";
            if (!$orderInsertResult) {
                throw new Exception("Error al insertar la orden");
            }

            $getOrderIdQuery = "SELECT LAST_INSERT_ID() AS order_id";
            $getOrderIdResult = $this->conn->query($getOrderIdQuery);
            if (DEBUG) echo "\n$getOrderIdQuery\n";
            if (!$getOrderIdResult) {
                throw new Exception("Error al obtener el order_id");
            }
            $orderIdRow = $getOrderIdResult->fetch_assoc();
            $orderId = $orderIdRow["order_id"];

            $cartResult->data_seek(0);
            while ($cartItem = $cartResult->fetch_assoc()) {
                $product_id = $cartItem['product_id'];
                $quantity = $cartItem['quantity'];
                $subtotal = $cartItem['subtotal'];

                $orderDetailInsertQuery = "INSERT INTO order_details (oreder_id, product_id, quantity, subtotal) VALUES (14, $product_id, $quantity, $subtotal)";
                $orderDetailInsertResult = $this->conn->query($orderDetailInsertQuery);
                if (DEBUG) echo "\n$orderDetailInsertQuery\n";
                if (!$orderDetailInsertResult) {
                    throw new Exception("Error al insertar el detalle de la orden");
                }
            }

            $cartDeleteQuery = "DELETE FROM shopping_cart WHERE user_id = $userId";
            $cartDeleteResult = $this->conn->query($cartDeleteQuery);
            if (DEBUG) echo "\n$cartDeleteQuery\n";

            if (!$cartDeleteResult) {
                throw new Exception("Error al eliminar el carrito");
            }

            $pdfFilePath = $this->generateOrderPDF($orderId);

            if (!$pdfFilePath) {
                throw new Exception("Error al generar el PDF de la orden");
            }

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'jesus.lopez280402@gmail.com';
                $mail->Password = 'wkfd ylem jcmv vuao';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('administrador@ansus.com', 'Ansus');
                $mail->addAddress($email, $name);
                $mail->isHTML(true);
                $mail->Subject = 'Confirmación de Pedido';
                $mail->Body = 'Gracias por comprar en Ansus.';

                $mail->addAttachment($pdfFilePath, 'Ticket.pdf');

                $mail->send();

                if (file_exists($pdfFilePath)) {
                    unlink($pdfFilePath);
                }

                return ["status" => "OK", "message" => "Pedido realizado exitosamente y correo enviado"];
            } catch (Exception $e) {
                return ["status" => "BAD", "message" => "Error al enviar el correo: " . $mail->ErrorInfo];
            }
        } catch (Exception $ex) {
            return ["status" => "BAD", "message" => $ex->getMessage()];
        }
    }



    function generateOrderPDF($orderId)
    {

        $orderQuery = "SELECT * FROM orders WHERE id = $orderId";
        $orderResult = $this->conn->query($orderQuery);

        if (!$orderResult || $orderResult->num_rows === 0) {
            return false;
        }



        $pdfFilePath = 'pdf/' . $orderId . '.pdf';


        return $pdfFilePath;
    }
}
