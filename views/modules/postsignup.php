<?php

?>
<div id="back"></div>


<div class="login-box">

  <div class="login-logo">

    

  </div>

  <div class="login-box-body">
    <h3>
      <center>Plataforma de Gestión Comunitaria </center>
    </h3>
    <p class="login-box-msg"> <b>Enviamos un código de validación a tu correo.</b></p>
    <form method="post">

      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Correo" name="validateEmail" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Codigo Validacion (AAA123)" name="validateCode" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="row">

        <div class="col-xs-4">

          <button type="submit" class="btn btn-primary btn-block btn-flat">Validar Codigo</button>

        </div>

      </div>

      <?php

      $validate = new ControllerSignUp();
      $validate->validateCodeUser();

      ?>

    </form>

  </div>

</div>