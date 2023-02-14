<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/dashboard_page.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Dashboard_Page::headerTemplate('Registrar primer usuario');
?>
<main class="container">  <!-- Abre contenedor para incluir el contenido de la pagina -->
    <head>  <!-- Manda a llamar el css de la pagina -->
        <link type="text/css" rel="stylesheet" href="../../resources/css/styles.css" />
    </head>                                                                                                                                                                                                                                         <br>
    <h3 class="center-align">Creación de primer usuario</h3>
    <!-- Formulario para registrar al primer usuario del dashboard -->
    <form method="post" id="register-form">
        <div class="row">
            <div class="input-field col s12 m6">
                <i class="material-icons prefix ">person_pin</i>
                <input id="txtAlias" type="text" name="txtAlias" autocomplete="off" class="validate" required />
                <label for="alias">Nombre de usuario</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">email</i>
                <input id="txtCorreo" type="email" name="txtCorreo" autocomplete="off" class="validate" required />
                <label for="correo">Correo</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix ">person_pin</i>
                <input id="txtDui" type="text" name="txtDui" autocomplete="off" class="validate" required />
                <label for="alias">Dui</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix ">person_pin</i>
                <input id="txtTelefono" type="text" name="txtTelefono" autocomplete="off" class="validate" required />
                <label for="alias">Telefono</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">security</i>
                <input id="txtClave1" type="password" name="txtClave1" autocomplete="off" class="validate" required />
                <label for="clave1">Clave</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">security</i>
                <input id="txtClave2" type="password" name="txtClave2" autocomplete="off" class="validate" required />
                <label for="clave2">Confirmar clave</label>
            </div>
        </div>
        <div class="row">
            <div class="col l7 m7 push-m5 push-l5 s7 push-s3">
                <button type="submit" class="button2"><i class="material-icons">add</i>Registrarse en
                    GameBridge</button>
            </div>
        </div>
    </form>
    <?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Dashboard_Page::footerTemplate('register.js');
?>