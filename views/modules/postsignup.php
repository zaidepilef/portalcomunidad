<?php


$_SESSION["email"] = $newuser["email"];
$_SESSION["status"] = $newuser["status"];

if (isset($_SESSION["email"]) && $_SESSION["status"] != 0) {
  
} else {


}

?>
<div id="back"></div>


<div class="login-box">

  <div class="login-logo">

    <img class="img-responsive" src="views/img/template/Logo-Agencia.png" style="padding: 5px 0px 0 0px">

  </div>

  <div class="login-box-body">
    <h3>
      <center>Plataforma de Gestión Comunitaria </center>
    </h3>
    <p class="login-box-msg"> <b>Regístrese para ser Ingresado al sistema</b></p>
    <form method="post">

    
      <div class="row">

        <div class="col-xs-4">

          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>

        </div>

      </div>

      <?php

      //$login = new ControllerSignUp();
      //$login->ctrUserSignUp();

      ?>

    </form>

  </div>

</div>