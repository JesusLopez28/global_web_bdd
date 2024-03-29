CREATE DATABASE ansus;

USE ansus;

CREATE TABLE
    users (
        ID INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID Usuario',
        name VARCHAR(255) COMMENT 'Nombre',
        last_name VARCHAR(255) COMMENT 'Apellido',
        email VARCHAR(255) UNIQUE COMMENT 'Correo',
        phone VARCHAR(255) COMMENT 'Telefono',
        password VARCHAR(255) COMMENT 'Contrasena',
        role ENUM('cliente', 'administrador') DEFAULT 'cliente' COMMENT 'Rol'
    );

CREATE TABLE
    auth_token (
        ID INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID Token',
        user_id INT COMMENT 'ID Usuario',
        token VARCHAR(255) COMMENT 'Token',
        creation_date DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha'
    );

CREATE TABLE
    categories (
        id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',
        name VARCHAR(255) COMMENT 'Categoria',
        description TEXT COMMENT 'Descripcion'
    );

CREATE TABLE
    products (
        id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',
        name VARCHAR(255) COMMENT 'Producto',
        price DECIMAL(10, 2) COMMENT 'Precio',
        category_id INT COMMENT 'ID Categoria',
        stock INT COMMENT 'Stock',
        image VARCHAR(255) COMMENT 'Imagen'
    );

CREATE TABLE
    shopping_cart (
        id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',
        user_id INT COMMENT 'ID Usuario',
        product_id INT COMMENT 'ID Producto',
        quantity INT COMMENT 'Cantidad',
        subtotal DECIMAL(10, 2) COMMENT 'Subtotal'
    );

CREATE TABLE
    orders (
        id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',
        user_id INT COMMENT 'ID Usuario',
        order_date DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha',
        status ENUM('confirmado', 'cancelado') DEFAULT 'confirmado' COMMENT 'Estatus',
        total DECIMAL(10, 2) COMMENT 'Total'
    );

CREATE TABLE
    order_details (
        id INT AUTO_INCREMENT PRIMARY KEY COMMENT 'ID',
        oreder_id INT COMMENT 'ID Pedido',
        product_id INT COMMENT 'ID Producto',
        quantity INT COMMENT 'Cantidad',
        subtotal DECIMAL(10, 2) COMMENT 'Subtotal'
    );
