<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANSUS - LOGIN</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/login.css">
</head>

<body>
    <div class="login-container">
        <img src="../assets/images/x.png" class="avatar" alt="">
        <h1>Iniciar Sesión</h1>
        <form method="post">
            <label>Email:</label>
            <input type="text" class="login-input" name="email " placeholder="Email" required>
            <label>Contraseña:</label>
            <div class="login-password">
                <input type="password" class="login-input password" name="password" id="password" placeholder="Contraseña" required>
                <span id="showPasswordButton" onclick="showPassword('password', 'showPasswordButton')">
                    <img src="../assets/icons/visible.png" alt="" class="icon">
                </span>
            </div>
            <button type="submit" class="login-btn">Iniciar Sesión</button>
            <div class="login-a">
                <a href="register.php">Registrate</a>
            </div>
        </form>
    </div>
    <script src="../assets/js/crud.js?x=1"></script>
</body>

</html>