<?php
// Se incluye la clase con las plantillas del documento.
require_once('../../app/helpers/public_page.php');
// Se imprime la plantilla del encabezado enviando el título de la página web.
Public_Page::headerTemplate2('Gamebridge | Inicio sesion','Iniciar sesión');
?>

<section>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="../../resources/img/equis.png"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">
                <form method="post" id="session-form">
                    <div class="d-flex align-items-center mb-3 pb-1">
                        <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                        <span class="h1 fw-bold mb-0">Login</span>
                    </div>
                    <h4 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Inicio de sesión</h4>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example17">Correo electronico</label>  
                        <input type="email" id="usuario" name="usuario" class="form-control form-control-lg" /> 
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example27">Contraseña</label>
                        <input type="password" id="clave" name="clave" class="form-control form-control-lg" />
                    </div>
                    <div class="pt-1 mb-4">
                        <center><button onclick="iniciarSesion()" class="btn btn-dark btn-lg btn-block botonLogin" type="button">Iniciar sesión</button></center>
                    </div>
                    <a class="small text-muted" href="#!">Olvidaste tu contraseña?</a>
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">No tienes una cuenta? 
                        <a href="index.php" style="color: #393f81;">Registrate aqui</a>
                    </p>    
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
// Se imprime la plantilla del pie enviando el nombre del controlador para la página web.
Public_Page::footerTemplate2('login.js');
?>