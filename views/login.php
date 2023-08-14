<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANSUS - LOGIN</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/login.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/alert.css">
    <link rel="icon" href="../assets/images/ansusIcon.png" type="image/x-icon">
</head>

<body>
    <div class="login-container">
        <img src="../assets/images/users.png" class="avatar" alt="">
        <h1>Iniciar Sesión</h1>
        <form id="login-form">
            <label>Email:</label>
            <input type="text" class="login-input" name="email" id="email" placeholder="Email" required>
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
    <script type="text/javascript">
        document.getElementById('login-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const requestData = {
                email: email,
                password: password
            };

            const fetchOptions = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestData)
            };

            fetch('http://127.0.0.1/controllers/redirect.php?endpoint=user.login', fetchOptions)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.code == "OK") {
                        window.parent.alertMessage("success", "¡Buen trabajo!", data.message);
                    } else {
                        window.parent.alertMessage("error", "¡Lo sentimos!", data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>