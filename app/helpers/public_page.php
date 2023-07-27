<?php
/*
*   Clase para definir las plantillas de las páginas web del sitio público.
*/
class Public_Page
{
    /*
    *   Método para imprimir la plantilla del encabezado.
    *
    *   Parámetros: $title (título de la página web).
    *
    *   Retorno: ninguno.
    */
    public static function headerTemplate($title)
    {
        // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en las páginas web.
        session_start();
        // Se imprime el código HTML para el encabezado del documento.
        print('
            <!DOCTYPE html>
            <html lang="es">
                <head>
                    <meta charset="utf-8">
                    <title>Coffeeshop - '.$title.'</title>
                    <link type="image/png" rel="icon" href="../../resources/img/logo.png"/>
                    <link type="text/css" rel="stylesheet" href="../../resources/css/materialize.min.css"/>
                    <link type="text/css" rel="stylesheet" href="../../resources/css/material_icons.css"/>
                    <link type="text/css" rel="stylesheet" href="../../resources/css/public.css"/>
                    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                </head>
                <body>
        ');
        // Se obtiene el nombre del archivo de la página web actual.
        $filename = basename($_SERVER['PHP_SELF']);
        // Se comprueba si existe una sesión de cliente para mostrar el menú de opciones, de lo contrario se muestra otro menú.
        if (isset($_SESSION['id_cliente'])) {
            // Se verifica si la página web actual es diferente a login.php y register.php, de lo contrario se direcciona a index.php
            if ($filename != 'login.php' && $filename != 'signin.php') {
                print('
                    <header>
                        <div class="navbar-fixed">
                            <nav class="green">
                                <div class="nav-wrapper">
                                    <a href="index.php" class="brand-logo"><img src="../../resources/img/logo.png" height="60"></a>
                                    <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                                    <ul class="right hide-on-med-and-down">
                                        <li><a href="index.php"><i class="material-icons left">view_module</i>Inicio</a></li>
                                        <li><a href="catalogo.php"><i class="material-icons left">view_module</i>Catálogo</a></li>
                                        <li><a href="cart.php"><i class="material-icons left">shopping_cart</i>Carrito</a></li>
                                        <li><a href="#" onclick="logOut()"><i class="material-icons left">close</i>Cerrar sesión</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <ul class="sidenav" id="mobile">
                            <li><a href="index.php"><i class="material-icons left">view_module</i>Catálogo</a></li>
                            <li><a href="cart.php"><i class="material-icons left">shopping_cart</i>Carrito</a></li>
                            <li><a href="#" onclick="logOut()"><i class="material-icons left">close</i>Cerrar sesión</a></li>
                        </ul>
                    </header>
                    <main>
                ');
            } else {
                header('location: index.php');
            }
        } else {
            // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para direccionar a index.php, de lo contrario se muestra un menú vacío.
            if ($filename != 'cart.php') {
                print('
                    <header>
                        <div class="navbar-fixed">
                            <nav class="green">
                                <div class="nav-wrapper">
                                    <a href="index.php" class="brand-logo"><img src="../../resources/img/logo.png" height="60"></a>
                                    <a href="#" data-target="mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                                    <ul class="right hide-on-med-and-down">
                                        <li><a href="index.php"><i class="material-icons left">view_module</i>Inicio</a></li>
                                        <li><a href="catalogo.php"><i class="material-icons left">view_module</i>Catálogo</a></li>
                                        <li><a href="signin.php"><i class="material-icons left">person</i>Crear cuenta</a></li>
                                        <li><a href="login.php"><i class="material-icons left">login</i>Iniciar sesión</a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <ul class="sidenav" id="mobile">
                            <li><a href="index.php"><i class="material-icons left">view_module</i>Inicio</a></li>
                            <li><a href="catalogo.php"><i class="material-icons left">view_module</i>Catálogo</a></li>
                            <li><a href="signin.php"><i class="material-icons left">person</i>Crear cuenta</a></li>
                            <li><a href="login.php"><i class="material-icons left">login</i>Iniciar sesión</a></li>
                        </ul>
                    </header>
                    <main>
                ');
            } else {
                header('location: login.php');
            }
        }

    }

    /*
    *   Método para imprimir la plantilla del pie.
    *
    *   Parámetros: $controller (nombre del archivo que sirve como controlador de la página web).
    *
    *   Retorno: ninguno.
    */
    public static function footerTemplate($controller)
    {
        // Se imprime el código HTML para el pie del documento.
        print('
                    <!-- Contenedor para mostrar efecto parallax con una altura de 300px e imagen aleatoria -->
                    <div class="parallax-container">
                        <div class="parallax">
                            <img id="parallax">
                        </div>
                    </div>
                </main>
                <footer class="page-footer green">
                    <div class="container">
                        <div class="row">
                            <div class="col s12 m6 l6">
                                <h5 class="white-text">Nosotros</h5>
                                <p>
                                    <blockquote>
                                        <a href="#mision" class="modal-trigger white-text"><b>Misión</b></a>
                                        <span>|</span>
                                        <a href="#vision" class="modal-trigger white-text"><b>Visión</b></a>
                                        <span>|</span>
                                        <a href="#valores" class="modal-trigger white-text"><b>Valores</b></a>
                                    </blockquote>
                                    <blockquote>
                                        <a href="#terminos" class="modal-trigger white-text"><b>Términos y condiciones</b></a>
                                    </blockquote>
                                </p>
                            </div>
                            <div class="col s12 m6 l6">
                                <h5 class="white-text">Contáctanos</h5>
                                <p>
                                    <blockquote>
                                        <a class="white-text" href="https://www.facebook.com/" target="_blank"><b>facebook</b></a>
                                        <span>|</span>
                                        <a class="white-text" href="https://twitter.com/" target="_blank"><b>twitter</b></a>
                                    </blockquote>
                                    <blockquote>
                                        <a class="white-text" href="https://www.instagram.com/" target="_blank"><b>instagram</b></a>
                                        <span>|</span>
                                        <a class="white-text" href="https://www.youtube.com/" target="_blank"><b>youtube</b></a>
                                    </blockquote>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="footer-copyright">
                        <div class="container">
                            <span>© Coffeeshop, todos los derechos reservados.</span>
                            <span class="grey-text text-lighten-4 right">Diseñado con <a class="red-text text-accent-1" href="http://materializecss.com/" target="_blank"><b>Materialize</b></a></span>
                        </div>
                    </div>
                </footer>
                <script type="text/javascript" src="../../resources/js/materialize.min.js"></script>
                <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
                <script type="text/javascript" src="../../app/helpers/components.js"></script>
                <script type="text/javascript" src="../../app/controllers/public/initialization.js"></script>
                <script type="text/javascript" src="../../app/controllers/public/account.js"></script>
                <script type="text/javascript" src="../../app/controllers/public/'.$controller.'"></script>
            </body>
            </html>
        ');
    }

    public static function headerTemplate2($title,$page)
    {
        session_start();
        $filename = basename($_SERVER['PHP_SELF']);

        print('
        <!DOCTYPE html>
        <html lang="es">
        
        <head>
          <meta charset="utf-8">
          <meta content="width=device-width, initial-scale=1.0" name="viewport">
        
          <title>'.$title.'</title>

          <link type="image/png" rel="icon" href="../../resources/img/brand/icono.png"/>
        
          <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    
          <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0" />
          <link href="../../resources/css/bootstrap.min.css" rel="stylesheet">
          <link href="../../resources/css/bootstrap-icons.css" rel="stylesheet">

          <link href="../../resources/css/styles.css" rel="stylesheet">
        ');

        if ($filename == 'productos.php') {
            print('
                <link href="../../resources/css/cards.css" rel="stylesheet">
            ');
        }

        // Se obtiene el nombre del archivo de la página web actual.
        $filename = basename($_SERVER['PHP_SELF']);
        // Se comprueba si existe una sesión de cliente para mostrar el menú de opciones, de lo contrario se muestra otro menú.
        if (isset($_SESSION['id_cliente'])) {
            // Se verifica si la página web actual es diferente a login.php y register.php, de lo contrario se direcciona a index.php
            if ($filename != 'login.php' && $filename != 'signin.php') {
                print('
                </head>

                <body>
              
                <header id="header" class="d-flex align-items-center">
                  <div class="container d-flex justify-content-between">
              
                    <div class="logo">
                      <h1 class="text-light"><a href="index.php">GameBridge</a></h1>
                    </div>
              
                    <nav id="navbar" class="navbar">
                      <ul>
                        <li><a class="nav-link scrollto " href="index.php">Inicio</a></li>
                        <li><a class="nav-link scrollto " href="catalogos.php">Catalogo</a></li>
                        <li><a class="nav-link scrollto" href="cart.php">Carrito</a></li>
                        <li><a class="nav-link scrollto"> Usuario: '.$_SESSION['correo_cliente'].'</a></li>
                        
                      </ul>
                      <i class="bi bi-list mobile-nav-toggle"></i>
                    </nav><!-- .navbar -->
              
                  </div>
                </header>
                ');
            } else {
                header('location: index.php');
            }
        } else {
            if ($filename != 'cart.php') {
                print('
                <body>
        
                <section id="topbar" class="d-flex align-items-center">
                  <div class="container d-flex justify-content-center justify-content-md-between">
                    <div class="contact-info d-flex align-items-center">
                      <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:Gamebridge@gmail.com">Gamebridge@gmail.com</a></i>
                      <i class="bi bi-phone d-flex align-items-center ms-4"><span>+503 7988 5288</span></i>
                    </div>
                    <div class="social-links d-none d-md-flex align-items-center">
                      <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                      <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                      <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                      <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
                    </div>
                  </div>
                </section>
              
                <header id="header" class="d-flex align-items-center">
                  <div class="container d-flex justify-content-between">
              
                    <div class="logo">
                      <h1 class="text-light"><a href="index.php">GameBridge</a></h1>
                    </div>
              
                    <nav id="navbar" class="navbar">
                      <ul>
                        <li><a class="nav-link scrollto " href="index.php">Inicio</a></li>
                        <li><a class="nav-link scrollto " href="catalogos.php">Catalogo</a></li>
                        <li><a class="nav-link scrollto" href="register.php">Crear Cuenta</a></li>
                        <li><a class="nav-link scrollto" href="signin.php">Iniciar Sesión</a></li>
                        
                      </ul>
                      <i class="bi bi-list mobile-nav-toggle"></i>
                    </nav>
              
                  </div>
                </header>
                ');
            } else {
                header('location: login.php');
            }
        }

        if ($filename != 'index.php' && $filename != 'carrito.php') {
            print('
            <section id="breadcrumbs" class="breadcrumbs">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 id="subtitulo">'.$page.'</h2>
                        <ol>
                        <li><a href="index.php">Inicio</a></li>
                        <li>'.$page.'</li>
                        </ol>
                    </div>
                </div>
          </section>');
        }
    }

    public static function footerTemplate2($controller)
    {
        $filename = basename($_SERVER['PHP_SELF']);
        if ($filename != 'carrito.php') {
            print('<!-- ======= Footer ======= -->
            <footer id="footer">
    
                <div class="container footer-bottom clearfix">
                <div class="copyright">
                    &copy; Copyright <strong><span>Remember</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
                </div>
            </footer>');
        } 
        // Se imprime el código HTML para el pie del documento.
        print('
                <script src="../../resources/js/bootstrap.bundle.min.js"></script>

                <script type="text/javascript" src="../../resources/js/main.js"></script>
                <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
                <script type="text/javascript" src="../../app/helpers/components.js"></script>
                <!--<script type="text/javascript" src="../../app/controllers/public/logout.js"></script> -->
                <script type="text/javascript" src="../../app/controllers/public/' . $controller . '"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        </body>

        </html>
        ');
    }
    
}
?>