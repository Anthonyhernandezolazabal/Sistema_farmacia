<div class='login-page'>
  <h1>FARMACIA</h1>
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card" id='login_pg'>
      <div class="card-body login-card-body">
        <p class="login-box-msg">Inicie Sesión para ingresar al sistema</p>
        <div id='alrt_succ_lg' class="alert alert-success" style='display:none;color: #000000;background: #28a74540;border-color: #23923d;'>
          <strong>Acceso correcto!</strong> Ingresando <i class="spinner-grow spinner-grow-sm"></i>
        </div>
        <form id='form_lg' method="post">

          <!-- ENTRADA DEL DNI -->
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="lg_dni" id="lg_dni" placeholder="DNI">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-id-card fa-lg"></span>
              </div>
            </div>
            <span id="alert_lg_dni" class="error invalid-feedback" style="display: none;"><i
                class='fas fa-times-circle'></i> <span id='alert_lg_dni_text'></span></span>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="lg_pass" id="lg_pass" class="form-control" placeholder="Contraseña">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock fa-lg"></span>
              </div>
            </div>
            <span id="alert_lg_pass" class="error invalid-feedback" style="display: none;"><i
                class='fas fa-times-circle'></i> <span id='alert_lg_pass_text'></span></span>
          </div>
          <div class="alert alert-danger alert-dismissible lg_alert_" style='display:none'>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Error!</h5>
            Usuario y/o Contraseña <b>incorrecto</b>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mt-3 mb-1">
          <a href="#" id='recuperar_pass'><b>¿Has olvidado la contraseña?</b></a>
        </p>
      </div>
    </div>


    <div class="card" style='display:none' id='recuperar_pg'>
      <div class="card-body login-card-body">
        <center>
          <h5><b>Recupera tu cuenta</b></h5>
        </center>
        <p class='text-center'>Introduce tu <code>DNI</code> y <code>Correo Electrónico</code> para validar
          usuario.</p>

        <form id='form_recuperar' method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id='dni_recuperar' placeholder="DNI">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-id-card fa-lg"></span>
              </div>
            </div>
            <span id="alert_rc_dni" class="error invalid-feedback" style="display: none;"><i
                class='fas fa-times-circle'></i> <span id='alert_rc_dni_text'></span></span>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id='email_recuperar' placeholder="Correo Electrónico">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope fa-lg"></span>
              </div>
            </div>
            <span id="alert_rc_email" class="error invalid-feedback" style="display: none;"><i
                class='fas fa-times-circle'></i> <span id='alert_rc_email_text'></span></span>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Validar</button>
            </div>
            <!-- /.col -->
          </div>


          <p class="text-danger" id='alert_prueba' style='display:none'></p>
          <p class="text-success" id='aviso2' style='display:none'></p>
        </form>
        <center><small>Se envía un código de validación a su <cite title="Source Title">Correo Electrónico
            </cite></small></center>
        <p class="mt-3 mb-1">
          <a href="#" id='recuperar_login'><b>Iniciar Sessión</b></a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</div>