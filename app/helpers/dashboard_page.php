<?php
/*
*	Clase para definir las plantillas de las páginas web del sitio privado.
*/
class Dashboard_Page
{
    /*
    *   Método para imprimir la plantilla del encabezado.
    *
    *   Parámetros: $title (título de la página web y del contenido principal).
    *
    *   Retorno: ninguno.
    */
    public static function headerTemplate($title)
    {
        // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en las páginas web.
        session_start();
        // Se imprime el código HTML de la cabecera del documento.
        print('       
        <!DOCTYPE html>
            <html lang="es">
              <head>
                <meta charset="utf-8"> 
                <!--Se importan los archivos CSS locales-->
                <link type="text/css" rel="stylesheet" href="../../resources/css/materialize.min.css" />
                <link type="text/css" rel="stylesheet" href="../../resources/css/dashboard_styles.css" />
                <link type="text/css" rel="stylesheet" href="../../resources/css/material_icons.css" />
                <link rel="icon" type="image/png" href="../../resources/img/brand/Logo.png" />
                <!--Se informa al navegador que el sitio web está optimizado para dispositivos móviles-->
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <!--Título del documento-->
                <title>Dashboard | ' . $title . '</title>
              </head>
            <body>
            <style>
                .nav{
                    background-color: rgb(10, 23, 51);
                }

                .centrar{
                    text-align:center;
                }
        
                .footer{
                    background-color: rgb(10, 23, 51);
                }
            </style>
        ');
        // Se obtiene el nombre del archivo de la página web actual.
        $filename = basename($_SERVER['PHP_SELF']);
        // Se comprueba si existe una sesión de administrador para mostrar el menú de opciones, de lo contrario se muestra un menú vacío.
        if (isset($_SESSION['idusuario'])) {
            // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para no iniciar sesión otra vez, de lo contrario se direcciona a main.php
            if ($filename != 'index.php' && $filename != 'register.php' && $filename != 'password.php' && $filename != 'codigo.php' && $filename != 'clave.php') {
                // Se compara el tipo de usuario que ha iniciado sesion en el sistema                
                if ($_SESSION['tipo'] == 1) {
                    // Se imprime el código HTML para el encabezado del documento con el menú de opciones.
                    if ($filename != 'autentication.php') {
                        print('
                        <!--Encabezado del documento-->
                        <header>
                            <!--Barra de navegación fija-->
                            <div class="navbar-fixed">
                                <nav class="nav">
                                    <div class="nav-wrapper">
                                        <a href="main.php" class="brand-logo"><img src="../../resources/img/brand/Logo.png" width="80" height="60.3"></a>
                                        <a href="#" data-target="mobile-sidenav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                                        <ul class="right hide-on-med-and-down">
                                            <li><a href="usuario.php"><i class="material-icons right">account_circle</i>Usuarios</a></li>
                                            <li><a href="products.php"><i class="material-icons right">shopping_cart</i>Productos</a></li>
                                            <li><a href="categorias.php"><i class="material-icons right">category</i>Categorías</a></li>
                                            <li><a href="clients.php"><i class="material-icons right">supervisor_account</i>Clientes</a></li>
                                            <li><a href="facturas.php"><i class="material-icons right">receipt</i>Facturas</a></li>
                                            <li><a href="valoraciones.php"><i class="material-icons right">chat_bubble_outline
                                            </i>Valoraciones</a></li>
                                            <li><a href="#" class="dropdown-trigger" data-target="dropdown"><i class="material-icons left">supervisor_account</i>Cuenta: <b>' . $_SESSION['usuario'] . '</b></a></li>
                                            </ul>
                                            <ul id="dropdown" class="dropdown-content">
                                                <li><a class ="black-text">Tipo: Root</a></li>
                                                <li><a href="#" onclick="openProfileDialog()" class = "black-text"><i class="material-icons">face</i>Editar perfil</a></li>
                                                <li><a href="#" onclick="openPasswordDialog()"class = "black-text"><i class="material-icons">lock</i>Cambiar clave</a></li>
                                                <li><a href="#" onclick="viewDevices()"class = "black-text"><i class="material-icons">devices</i>Mis dispositivos</a></li>
                                                <li><a href="#" onclick="logOut()"class = "black-text"><i class="material-icons">clear</i>Salir</a></li>
                                            </ul>
                                    </div>
                                </nav>
                            </div>
                            <!--Navegación lateral para dispositivos móviles-->
                            <ul class="sidenav" id="mobile-sidenav">
                                <li><a href="usuarios.php"><i class="material-icons right">account_circle</i>Usuarios</a></li>
                                <li><a href="products.php"><i class="material-icons right">shopping_cart</i>Productos</a></li>
                                <li><a href="clients.php"><i class="material-icons right">supervisor_account</i>Clientes</a></li>
                                <li><a href="facturas.php"><i class="material-icons right">receipt</i>Facturas</a></li>
                                <li><a href="valoraciones.php"><i class="material-icons right">chat_bubble_outline</i>Valoraciones</a></li>
                                <li><a href="#" class="dropdown-trigger" data-target="dropdown-mobile"><i class="material-icons left">supervisor_account</i>Cuenta: <b>' . $_SESSION['usuario'] . '</b></a></li>
                                </ul>

                                <ul id="dropdown-mobile" class="dropdown-content dropdown">
                                <li><a href="#" onclick="openProfileDialog()"><i class="material-icons">face</i>Editar perfil</a></li>
                                <li><a href="#" onclick="openPasswordDialog()"><i class="material-icons">lock</i>Cambiar clave</a></li>
                                <li><a href="#" onclick="viewDevices()"class = "black-text"><i class="material-icons">devices</i>Mis dispositivos</a></li>
                                <li><a href="#" onclick="logOut()"><i class="material-icons">clear</i>Salir</a></li>
                            </ul>
                        </header>
                        <!--Contenido principal del documento-->
                        <main>
                        ');
                    }
                } else {
                    // Se imprime el código HTML para el encabezado del documento con el menú de opciones.
                    if ($filename != 'autentication.php' && $filename != 'clave.php') {
                        print('
                        <!--Encabezado del documento-->
                        <header>
                            <!--Barra de navegación fija-->
                            <div class="navbar-fixed">
                                <nav class="nav">
                                    <div class="nav-wrapper">
                                        <a href="main.php" class="brand-logo"><img src="../../resources/img/brand/Logo.png" width="80" height="60.3"></a>
                                        <a href="#" data-target="mobile-sidenav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                                        <ul class="right hide-on-med-and-down">
                                            <li><a href="products.php"><i class="material-icons right">shopping_cart</i>Productos</a></li>
                                            <li><a href="categorias.php"><i class="material-icons right">category</i>Categorías</a></li>
                                            <li><a href="clients.php"><i class="material-icons right">supervisor_account</i>Clientes</a></li>
                                            <li><a href="#" class="dropdown-trigger" data-target="dropdown"><i class="material-icons left">account_circle</i>Cuenta: <b>' . $_SESSION['usuario'] . '</b></a></li>
                                            </ul>
                                            <ul id="dropdown" class="dropdown-content">
                                                <li><a class ="black-text">Tipo: Admin</a></li>
                                                <li><a href="#" onclick="openProfileDialog()" class = "black-text"><i class="material-icons">face</i>Editar perfil</a></li>
                                                <li><a href="#" onclick="openPasswordDialog()"class = "black-text"><i class="material-icons">lock</i>Cambiar clave</a></li>
                                                <li><a href="#" onclick="viewDevices()"class = "black-text"><i class="material-icons">devices</i>Mis dispositivos</a></li>
                                                <li><a href="#" onclick="logOut()"class = "black-text"><i class="material-icons">clear</i>Salir</a></li>
                                            </ul>
                                    </div>
                                </nav>
                            </div>
                            <!--Navegación lateral para dispositivos móviles-->
                            <ul class="sidenav" id="mobile-sidenav">
                                <li><a href="products.php"><i class="material-icons right">shopping_cart</i>Productos</a></li>
                                <li><a href="categorias.php"><i class="material-icons right">category</i>Categorías</a></li>
                                <li><a href="clients.php"><i class="material-icons right">supervisor_account</i>Clientes</a></li>
                                <li><a href="#" class="dropdown-trigger" data-target="dropdown-mobile"><i class="material-icons left">account_circle</i>Cuenta: <b>' . $_SESSION['usuario'] . '</b></a></li>
                                </ul>
                                <ul id="dropdown-mobile" class="dropdown-content dropdown">
                                <li><a href="#" onclick="openProfileDialog()"><i class="material-icons">face</i>Editar perfil</a></li>
                                <li><a href="#" onclick="openPasswordDialog()"><i class="material-icons">lock</i>Cambiar clave</a></li>
                                <li><a href="#" onclick="viewDevices()"class = "black-text"><i class="material-icons">devices</i>Mis dispositivos</a></li>
                                <li><a href="#" onclick="logOut()"><i class="material-icons">clear</i>Salir</a></li>
                            </ul>
                        </header>
                        <!--Contenido principal del documento-->
                        <main>
                        ');
                    } 
                }
            } else {
                header('location: main.php');
            }
        } else {
            // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para direccionar a index.php, de lo contrario se muestra un menú vacío.
            if ($filename != 'index.php' && $filename != 'register.php' && $filename != 'password.php' && $filename != 'codigo.php' && $filename != 'clave.php') {
                header('location: index.php');
            } else {
                // Se imprime el código HTML para el encabezado del documento con un menú vacío cuando sea iniciar sesión o registrar el primer usuario.
                print('
                <header>
                
            </header>
                ');
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
        // Se comprueba si existe una sesión de administrador para imprimir el pie respectivo del documento.
        if (isset($_SESSION['idusuario'])) {
            $scripts = '
                <script type="text/javascript" src="../../resources/js/materialize.min.js"></script>
                <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
                <script type="text/javascript" src="../../app/helpers/components.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/initialization.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/account.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/logout.js"></script>

                <script type="text/javascript" src="../../app/controllers/dashboard/' . $controller . '"></script>
            ';
        } else {
            $scripts = '
                <script type="text/javascript" src="../../resources/js/materialize.min.js"></script>
                <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
                <script type="text/javascript" src="../../app/helpers/components.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/' . $controller . '"></script>
            ';
        }
        print('
        </main>
        <footer class="" >

                    ' . $scripts . '
                    </footer>
                </body>
            </html>
        ');
    }

    public static function headerTemplate2($title,$page)
    {
        // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en las páginas web.
        session_start();
        // Se imprime el código HTML de la cabecera del documento.
        print('       
        <!DOCTYPE html>
            <html lang="es">

            <head>
            <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1.0" name="viewport">

            <title>' . $title . '</title>
            <meta content="" name="description">
            <meta content="" name="keywords">

            <!-- Favicons -->
            <link href="../../resources/img/brand/Logo.png" rel="icon">

            <link type="text/css" rel="stylesheet" href="../../resources/css/dashboard_styles.css" />
            <link type="text/css" rel="stylesheet" href="../../resources/css/material_icons.css" />

            <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
            <link href="../../framework/aos/aos.css" rel="stylesheet">
            <link href="../../framework/bootstrap/css/bootstrap.min.css" rel="stylesheet">
            <link href="../../framework/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
            <link href="../../framework/boxicons/css/boxicons.min.css" rel="stylesheet">
            <link href="../../framework/glightbox/css/glightbox.min.css" rel="stylesheet">
            <link href="../../framework/swiper/swiper-bundle.min.css" rel="stylesheet">
            <link href="../../resources/css/styles.css" rel="stylesheet">

            </head>
            <body>
            <section id="topbar" class="d-flex align-items-center">
                <div class="container d-flex justify-content-center justify-content-md-between">
                <div class="contact-info d-flex align-items-center">
                    <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:' . $_SESSION['correo'] . '">' . $_SESSION['correo'] . '</a></i>
                    <i class="bi bi-phone d-flex align-items-center ms-4"><span>+503 ' . $_SESSION['telefono'] . '</span></i>
                </div>
                <div class="social-links d-none d-md-flex align-items-center">
                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                </div>
                </div>
            </section>
        ');
        // Se obtiene el nombre del archivo de la página web actual.
        $filename = basename($_SERVER['PHP_SELF']);
        // Se comprueba si existe una sesión de administrador para mostrar el menú de opciones, de lo contrario se muestra un menú vacío.
        if (isset($_SESSION['idusuario'])) {
            // Se verifica si la página web actual es diferente a index.php (Iniciar sesión) y a register.php (Crear primer usuario) para no iniciar sesión otra vez, de lo contrario se direcciona a main.php
            if ($filename != 'index.php' && $filename != 'register.php') {
                // Se compara el tipo de usuario que ha iniciado sesion en el sistema   
                if ($_SESSION['tipo'] == 'Root') {
                    print('
                        <header id="header" class="d-flex align-items-center">
                        <div class="container d-flex justify-content-between">
                    
                        <div class="logo">
                            <h1 class="text-light"><a href="main.php">GameBridge</a></h1>
                        </div>
                    
                        <nav id="navbar" class="navbar">
                            <ul>
                            <li><a class="nav-link scrollto " href="usuarios.php">Usuarios</a></li>
                            <li><a class="nav-link scrollto " href="clientes.php">Clientes</a></li>
                            <li><a class="nav-link scrollto" href="categorias.php">Categorias</a></li>
                            <li><a class="nav-link scrollto" href="productos.php">Productos</a></li>
                            <li><a class="nav-link scrollto" href="facturas.php">Facturas</a></li>
                            <li><a onclick="logOut()" class="nav-link scrollto">Usuario: <b>'. $_SESSION['usuario'] .'</b><i class="bi bi-person-fill"></i></a></li>
                            </ul>
                            <i class="bi bi-list mobile-nav-toggle"></i>
                        </nav>
                    
                        </div>
                    </header>    

                    <main id="main">

                    <section class="breadcrumbs">
                    <div class="container">');
                } else {

                }  
                if ($filename != 'main.php') {
                    print('<div class="d-flex justify-content-between align-items-center">
                        <h2>Mantenimiento de ' . $page . '</h2>
                        <ol>
                            <li><a href="main.php">Inicio</a></li>
                            <li>' . $page . '</li>
                        </ol>
                        </div>
                    </div>
                    </section>');
                } else {
                    print('<div class="d-flex justify-content-between align-items-center">
                        <h2>Bienvenido al sistema ' . $_SESSION['usuario'] . '</h2>
                        <ol>
                            <li><a href="main.php">Pagina principal</a></li>
                            <li>Tipo usuario: '.$_SESSION['tipo'].'</li>
                        </ol>
                        </div>
                    </div>
                    </section>');
                }        
            } else {
                header('location: main.php');
            }
        } else {
            header('location: index.php');
        }
    }

    /*
    *   Método para imprimir la plantilla del pie.
    *
    *   Parámetros: $controller (nombre del archivo que sirve como controlador de la página web).
    *
    *   Retorno: ninguno.
    */
    public static function footerTemplate2($controller)
    {
        $filename = basename($_SERVER['PHP_SELF']);
        if ($filename != 'productos.php') {
            print('
            </main>
            <footer id="footer">
                <div class="container footer-bottom clearfix">
                <div class="copyright">
                    &copy; Copyright <strong><span>Gamebridge</span></strong>. Derechos reservados
                </div>
                <div class="credits">
                </div>
                </div>
            </footer>
                <script src="../../framework/purecounter/purecounter_vanilla.js"></script>
                <script src="../../framework/aos/aos.js"></script>
                <script src="../../framework/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="../../framework/glightbox/js/glightbox.min.js"></script>
                <script src="../../framework/isotope-layout/isotope.pkgd.min.js"></script>
                <script src="../../framework/swiper/swiper-bundle.min.js"></script>

                <script type="text/javascript" src="../../resources/js/main.js"></script>
                <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
                <script type="text/javascript" src="../../app/helpers/components.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/logout.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/' . $controller . '"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            </body>
            </html>');
        } else {
            print(' <script src="../../framework/purecounter/purecounter_vanilla.js"></script>
                <script src="../../framework/aos/aos.js"></script>
                <script src="../../framework/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="../../framework/glightbox/js/glightbox.min.js"></script>
                <script src="../../framework/isotope-layout/isotope.pkgd.min.js"></script>
                <script src="../../framework/swiper/swiper-bundle.min.js"></script>

                <script type="text/javascript" src="../../resources/js/main.js"></script>
                <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
                <script type="text/javascript" src="../../app/helpers/components.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/logout.js"></script>
                <script type="text/javascript" src="../../app/controllers/dashboard/' . $controller . '"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            </body>
            </html>');
        }
    }
}