<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Bienvenido, comunidad en línea:

      <small>Panel de Control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Tablero</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <?php
      
      
          echo '<h1> Bienvenido ' .$_SESSION["username"].'</h1>';
      

      
      ?>

    </div>

    <div class="row">

      <div class="col-lg-12">

        <?php

        

        ?>

      </div>

      <div class="col-lg-6">

        <?php

      
        

        ?>

      </div>

      <div class="col-lg-6">

      

      </div>

      <div class="col-lg-12">
        <?php
        /*
        if ($_SESSION["profile"] == "Special" || $_SESSION["profile"] == "Seller") {
          echo '<div class="box box-success">
           <div class="box-header">
           <h1>Welcome ' . $_SESSION["username"] . '</h1>
           </div>
           </div>';
        }*/
        ?>
        <div class="box box-success">
          <div class="box-header">
            <h1>Welcome <?php $_SESSION["username"] ?>
            </h1>
          </div>
        </div>
      </div>

    </div>

  </section>

</div>