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
      /*
        if($_SESSION["profile"] =="Administrator"){
          echo '<h1> Bienvenido ' .$_SESSION["name"].'</h1>';
          include "home/top-boxes.php";

        }

        if($_SESSION["profile"] =="Encargado EE"){

          echo '<h1> <center> <font color="navy"> Bienvenido ' .$_SESSION["name"].'</font></center> </h1>';
          //echo '<h3>   Reporte de sus consumos de Energía  </h3>';
          include "home/top-boxes-colegios.php";

        }
        */
      ?>

    </div>

    <div class="row">

      <div class="col-lg-12">

        <?php

        include "reports/sales-graph.php";
        /*
        if ($_SESSION["profile"] == "Administrator") {
          include "reports/sales-graph.php";
        }
        */

        ?>

      </div>

      <div class="col-lg-6">

        <?php

        if ($_SESSION["profile"] == "Administrator") {

          include "reports/bestseller-products.php";
        }

        ?>

      </div>

      <div class="col-lg-6">

        <?php

        if ($_SESSION["profile"] == "Administrator") {

          include "home/recent-products.php";
        }

        ?>

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