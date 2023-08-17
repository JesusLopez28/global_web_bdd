<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANSUS - GESTOR USUARIOS</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/modal.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/alert.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/table.css">
    <link rel="icon" href="../assets/images/ansusIcon.png" type="image/x-icon">
</head>

<body id="body">

    <header>
        <div class="icon__menu">
            <img src="../assets/icons/menu.png" id="btn_open" alt="Menú">
        </div>
        <div class="header__container" id="header">
            <div class="search__container">
                <input type="text" class="search-input" name="search" id="search" placeholder="Buscar..." required>
                <span id="search_button">
                    <img src="../assets/icons/lupa.png" alt="" class="icon">
                </span>
            </div>
        </div>
    </header>

    <div class="menu__side" id="menu_side">
        <div class="name__page">
            <img src="../assets/icons/ansus.png" alt="Ansus">
            <h4>ANSUS</h4>
        </div>

        <div class="options__menu" id="main_menu">

        </div>
    </div>

    <main id="main">
        <h1>Gestión de Usuarios</h1><br>
    </main>

    <div class="body__Page">
        <div class="table-container">
            <table id="table_crud">
                <thead>
                    <tr id="tr-headers"></tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>

        <div class="pagination_rows"></div>
        <ul class="pagination"></ul>
    </div>

    <button id="openModalBtn" onclick="openModal();" class="openModalBtn">Agregar Usuario</button>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Agregar/Editar Usuario</h2>
            <form id="form" onsubmit='return create("users", "form")' enctype="multipart/form-data">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required><br>
                <label for="last_name">Apellido:</label>
                <input type="text" id="last_name" name="last_name" required><br>
                <label for="email">Correo:</label>
                <input type="email" id="email" name="email" required><br>
                <label for="phone">Teléfono:</label>
                <input type="tel" id="phone" name="phone"><br>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required><br>
                <label for="role">Rol:</label>
                <select id="role" name="role">
                    <option value="cliente">Cliente</option>
                    <option value="administrador">Administrador</option>
                </select><br>
                <button type="submit">Agregar</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="container__footer">
            <div class="box__footer">
                <h2>Aviso</h2>
                <div class="terms">
                    <p>Esta página no es oficial, solo para fines educativos, toda la información de esta página es ficticia al igual que los datos y los productos.</p>
                </div>
            </div>
            <div class="box__footer">
                <h2>Se utilizó</h2>
                <a href="https://www.w3schools.com/html/default.asp">HTML</a>
                <a href="https://www.w3schools.com/css/default.asp">CSS</a>
                <a href="https://www.w3schools.com/php/default.asp">PHP</a>
                <a href="https://www.w3schools.com/mysql/default.asp">MySQL</a>
                <a href="https://www.w3schools.com/js/default.asp">JS</a>
            </div>

            <div class="box__footer">
                <h2>Autor</h2>
                <div class="terms">
                    <p>Jesús López<br>22110104</p>
                </div>
            </div>

            <div class="box__footer">
                <h2>Redes Sociales</h2>
                <a href="#"> <i class="fab fa-facebook-square"></i> Facebook</a>
                <a href="#"><i class="fab fa-twitter-square"></i> Twitter</a>
                <a href="#"><i class="fab fa-instagram-square"></i> Instagram</a>
            </div>

        </div>

        <div class="box__copyright">
            <hr>
            <p>Todos los derechos reservados © 2023 <b>Ansus</b></p>
        </div>
    </footer>
    <script src="../assets/js/manage.js?x=1"></script>
    <script src="../assets/js/crud.js?x=1"></script>
    <script src="../assets/js/general.js?x=1"></script>
    <script src="../assets/js/lateral.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const modal = document.getElementById("modal");
            modal.style.display = "none";
        });

        getCrud("users");

        document.addEventListener('DOMContentLoaded', function() {
            var searchButton = document.getElementById('search_button');
            var inputSearch = document.getElementById('search');

            searchButton.addEventListener('click', function() {
                var inputValue = inputSearch.value;
                getRows('users', inputValue, 0);
            });
        });
    </script>
</body>

</html>