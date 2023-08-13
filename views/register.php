<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANSUS - REGISTER</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/register.css">
</head>

<body>
    <div class="login-container">
        <img src="../assets/images/x.png" class="avatar" alt="">
        <h1>Registrate</h1>
        <form action="#" method="post">
            <label>Nombre:</label>
            <input type="text" class="login-input" name="name" placeholder="Nombre" required>
            <label>Apellido:</label>
            <input type="text" class="login-input" name="last_name" placeholder="Apellido" required>
            <label>Telefono/Celular:</label>
            <input type="text" class="login-input" name="phone" placeholder="Telefono/Celular" required>
            <label>Email:</label>
            <input type="text" class="login-input" name="email" placeholder="Email" required>
            <label>Contraseña:</label>
            <div class="login-password">
                <input type="password" class="login-input password" name="password" id="password" placeholder="Contraseña" required>
                <span id="showPasswordButton" onclick="showPassword('password', 'showPasswordButton')">
                    <img src="../assets/icons/visible.png" alt="" class="icon">
                </span>
            </div>
            <label>Repetir Contraseña:</label>
            <div class="login-password">
                <input type="password" class="login-input password" name="password" id="repitedPassword" placeholder="Contraseña" required>
                <span id="showRepitedPasswordButton" onclick="showPassword('repitedPassword', 'showRepitedPasswordButton')">
                    <img src="../assets/icons/visible.png" alt="" class="icon">
                </span>
            </div>
            <button type="submit" class="login-btn">Registrate</button>
            <div class="login-a">
                <a href="login.php">Login</a>
            </div>
        </form>
    </div>
    <script src="../assets/js/crud.js?x=1"></script>
</body>

</html>