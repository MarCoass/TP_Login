<?php include_once('common/header.php') ?>


<div class="modal modal-signin position-static d-block py-5" tabindex="-1" role="dialog" id="modalSignin">
  <div class="modal-dialog" role="document">
    <div class="modal-content rounded-4 shadow">
      <div class="modal-header p-5 pb-4 border-bottom-0">
        <!-- <h1 class="modal-title fs-5" >Modal title</h1> -->
        <h1 class="fw-bold mb-0 fs-2">Iniciar Sesion</h1>
      </div>

      <div class="modal-body p-5 pt-0">
        <form class="" action="POST">
          <div class="form-floating mb-3">
            <input type="usuario" class="form-control rounded-3" id="floatingInput" placeholder="Usuario">
            <label for="floatingInput">Usuario</label>
          </div>
          <div class="form-floating mb-3">
            <input type="contrasenia" class="form-control rounded-3" id="floatingPassword" placeholder="Contraseña">
            <label for="floatingPassword">Contraseña</label>
          </div>
          <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Iniciar Sesion</button>

        </form>
        <hr>
        <p class="align-center text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          Nueva cuenta
        </p>

        <div class="collapse" id="collapseExample">
          <form class="" action="actualizarLogin.php" method="POST">
            <div class="form-floating mb-3">
              <input type="text" class="form-control rounded-3" id="floatingInput" placeholder="Usuario" name="usuario">
              <label for="floatingInput">Usuario</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Contraseña" name="contrasenia">
              <label for="floatingPassword">Contraseña</label>
            </div>
            <button class="w-100 mb-2 btn btn-lg rounded-3 btn-primary" type="submit">Registrarse</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('common/footer.php') ?>