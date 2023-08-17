<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANSUS</title>
    <link rel="stylesheet" type="text/css" href="assets/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="assets/css/alert.css">
    <link rel="icon" href="assets/images/ansusIcon.png" type="image/x-icon">
</head>

<body id="body">

    <header>
        <div class="icon__menu">
            <img src="assets/icons/menu.png" id="btn_open" alt="Menú">
        </div>
        <div class="header__container" id="header">
            <div class="search__container">
                <input type="text" class="search-input" name="search" id="search" placeholder="Buscar..." required>
                <span>
                    <img src="assets/icons/lupa.png" alt="" class="icon" onclick="window.location.href = 'views/login.php';">
                </span>
            </div>
        </div>
    </header>

    <div class="menu__side" id="menu_side">
        <div class="name__page">
            <img src="assets/icons/ansus.png" alt="Ansus">
            <h4>ANSUS</h4>
        </div>

        <div class="options__menu" id="main_menu">
            <a href="index.php" class="selected">
                <div class="option" id="home">
                    <img src="assets/icons/home.png" alt="Home">
                    <h4>Home</h4>
                </div>
            </a>
            <a href="views/login.php">
                <div class="option" id="Car">
                    <img src="assets/icons/carrito.png" alt="carrito">
                    <h4>Carrito</h4>
                </div>
            </a>
            <a href="views/login.php" id="Login">
                <div class="option">
                    <img src="assets/icons/login.png" alt="Login">
                    <h4>Login</h4>
                </div>
            </a>
            <a href="views/register.php" id="Register">
                <div class="option">
                    <img src="assets/icons/register.png" alt="Registrate">
                    <h4>Registrate</h4>
                </div>
            </a>
        </div>
    </div>

    <main>
        <h1>Bienvenido a Ansus</h1><br>
        <nav>
            <ul class="menu">
                <li><a href="views/login.php">Sofás</a></li>
                <li><a href="views/login.php">Mesas</a></li>
                <li><a href="views/login.php">Sillas</a></li>
                <li><a href="views/login.php">Camas</a></li>
                <li><a href="views/login.php">Escritorios</a></li>
                <li><a href="views/login.php">Colchones</a></li>
                <li><a href="views/login.php">Cómodas</a></li>
                <li><a href="views/login.php">Comedores</a></li>
            </ul>
        </nav>
    </main>

    <div class="body__Page">
        <div class="container__article">
        <div class="box__article">
                <img src="assets/images/products/sofaCafe.png" alt="">
                <h4>Sofá café</h4>
                <p>Precio: $4,200</p>
                <a href="views/login.php">Agregar al carrito</a>
            </div>

            <div class="box__article">
                <img src="assets/images/products/mesaMadera.png" alt="">
                <h4>Mesa de madera</h4>
                <p>Precio: $3,100</p>
                <a href="views/login.php">Agregar al carrito</a>
            </div>

            <div class="box__article">
                <img src="assets/images/products/sillaAcolchonada.png" alt="">
                <h4>Silla acolchonada</h4>
                <p>Precio: $1,500</p>
                <a href="views/login.php">Agregar al carrito</a>
            </div>

            <div class="box__article">
                <img src="assets/images/products/camaTapizada.png" alt="">
                <h4>Cama Tapizada</h4>
                <p>Precio: $6,000</p>
                <a href="views/login.php">Agregar al carrito</a>
            </div>

            <div class="box__article">
                <img src="assets/images/products/escritorioOficina.png" alt="">
                <h4>Escritorio de Oficina</h4>
                <p>Precio: $4,800</p>
                <a href="views/login.php">Agregar al carrito</a>
            </div>

            <div class="box__article">
                <img src="assets/images/products/colchonMatrimonial.png" alt="">
                <h4>Colchon Matrimonial</h4>
                <p>Precio: $5,900</p>
                <a href="views/login.php">Agregar al carrito</a>
            </div>

            <div class="box__article">
                <img src="assets/images/products/comodaMadera.png" alt="">
                <h4>Comoda de Madera</h4>
                <p>Precio: $1,500</p>
                <a href="views/login.php">Agregar al carrito</a>
            </div>

            <div class="box__article">
                <img src="assets/images/products/comedorPeque.png" alt="">
                <h4>Comedor Pequeño</h4>
                <p>Precio: $8,200</p>
                <a href="views/login.php">Agregar al carrito</a>
            </div>
        </div>
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
    <script src="assets/js/manage.js?x=1"></script>
    <script src="assets/js/crud.js?x=1"></script>
    <script src="assets/js/general.js?x=1"></script>
    <script src="assets/js/lateral.js"></script>
    <script type="text/javascript">
        fetch('http://127.0.0.1/controllers/redirect.php?endpoint=object.getIndex', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    "object": {}
                })
            })
            .then(response => response.json())
            .then(data => {

            })
            .catch(error => {
                console.error('Error:', error);
            });
    </script>
</body>

</html>