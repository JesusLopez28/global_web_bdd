<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANSUS - REGISTER</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/login.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/alert.css">
    <link rel="icon" href="../assets/images/ansusIcon.png" type="image/x-icon">
</head>

<body>
    <div class="login-container register">
        <img src="../assets/images/users.png" class="avatar" alt="">
        <h1>Registrate</h1>
        <form id="register-form">
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
            <button type="submit" class="login-btn">Registrate</button>
            <div class="login-a">
                <a href="login.php">Login</a>
            </div>
        </form>
    </div>
    <script src="../assets/js/manage.js?x=1"></script>
    <script src="../assets/js/crud.js?x=1"></script>
    <script src="../assets/js/general.js?x=1"></script>
    <script src="../assets/js/lateral.js"></script>
    <script type="text/javascript">
        document.getElementById('register-form').addEventListener('submit', function(event) {
            event.preventDefault();

            var form_data = JSON.parse(formJSON('register-form'));

            const requestData = {
                data: form_data
            };

            const fetchOptions = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(requestData)
            };

            fetch('../controllers/redirect.php?endpoint=user.register', fetchOptions)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status == "OK") {
                        window.parent.alertMessage("success", "¡Buen trabajo!", data.message);
                        window.location.href = "login.php";
                    } else {
                        window.parent.alertMessage("error", "¡Lo sentimos!", data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    window.parent.alertMessage("error", "¡Lo sentimos!", error);
                });
        });
    </script>
</body>

</html>