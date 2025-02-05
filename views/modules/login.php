<div id="back"></div>


<div class="login-box">

  <div class="login-logo">

    <img class="img-responsive" src="views/img/template/Logo-Agencia.png" style="padding: 5px 0px 0 0px">

  </div>

  <div class="login-box-body">
      <h3><center>Oficina virtual Vecinos </center></h3>
      <p class="login-box-msg"> <b>Regístrese para iniciar su sesión</b></p>
      <form method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Usuario" name="loginUser" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="loginPass" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">

        <div class="col-xs-4">

          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>

        </div>

      </div>

      <?php

        $login = new ControllerUsers();
        $login -> ctrUserLogin();

      ?>

    </form>

  </div>

</div>
