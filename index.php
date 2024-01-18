<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ANSUS</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/fonts.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/modal.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/alert.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/table.css">
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
                <img src="assets/images/products/sillaAcojinada.png" alt="">
                <h4>Silla acojinada</h4>
                <p>Precio: $1,500</p>
                <a href="views/login.php">Agregar al carrito</a>
            </div>

            <div class="box__article">
                <img src="assets/images/products/camaTapizada.png" alt="">
                <h4>Cama tapizada</h4>
                <p>Precio: $6,000</p>
                <a href="views/login.php">Agregar al carrito</a>
            </div>

            <div class="box__article">
                <img src="assets/images/products/escritorioOficina.png" alt="">
                <h4>Escritorio de oficina</h4>
                <p>Precio: $4,800</p>
                <a href="views/login.php">Agregar al carrito</a>
            </div>

            <div class="box__article">
                <img src="assets/images/products/colchonMatrimonial.png" alt="">
                <h4>Colchon matrimonial</h4>
                <p>Precio: $5,900</p>
                <a href="views/login.php">Agregar al carrito</a>
            </div>

            <div class="box__article">
                <img src="assets/images/products/comodaMadera.png" alt="">
                <h4>Comoda de madera</h4>
                <p>Precio: $1,500</p>
                <a href="views/login.php">Agregar al carrito</a>
            </div>

            <div class="box__article">
                <img src="assets/images/products/comedorPeque.png" alt="">
                <h4>Comedor pequeño</h4>
                <p>Precio: $8,200</p>
                <a href="views/login.php">Agregar al carrito</a>
            </div>
        </div>

        <section class="mission">
            <h2>Nuestra Misión</h2>
            <p>En Ansus, nuestra misión es transformar espacios en hogares de ensueño, ofreciendo muebles de calidad excepcional que reflejen estilo, comodidad y funcionalidad. Nos esforzamos por superar las expectativas de nuestros clientes al proporcionar soluciones de diseño personalizadas y una experiencia de compra sin igual. Guiados por la pasión por la excelencia, estamos comprometidos con la innovación continua y la satisfacción total de nuestros clientes.</p>
        </section>

        <section class="vision">
            <h2>Nuestra Visión</h2>
            <p>Nos visualizamos como líderes en la industria de muebles, reconocidos por nuestra dedicación a la artesanía impecable y la creación de ambientes inspiradores. Queremos ser la elección natural para aquellos que buscan mobiliario que combine estética, comodidad y calidad duradera. Con un enfoque en la sostenibilidad y la responsabilidad social, aspiramos a expandir nuestro alcance global y enriquecer la vida de las personas a través de la creación de espacios excepcionales.</p>
        </section>

        <section class="google-map">
            <h2>Encuéntranos</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3733.332743015029!2d-103.2503276239727!3d20.65603750047448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428b416a05e521b%3A0x4d1c9ef1bafe18d9!2sManuel%20L%C3%B3pez%20Cotilla%2097%2C%20Basilio%20Badillo%20II%2C%2045406%20Tonal%C3%A1%2C%20Jal.!5e0!3m2!1ses-419!2smx!4v1692364513319!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>

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
</body>

</html>