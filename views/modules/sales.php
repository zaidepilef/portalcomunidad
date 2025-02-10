<?php

if ($_SESSION["profile"] == "Special") {

  echo '<script>

    window.location = "home";

  </script>';

  return;
}

?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administración de Reportes

    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Tablero</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="create-sale">
          <button class="btn btn-primary">

            Agregar Reporte

          </button>
        </a>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tables" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Código</th>
              <th>Establecimiento</th>
              <th>Usuario</th>
              <th>Distribuidora</th>
              <th>Total Consumos KWh </th>
              <th>Total Costos $</th>
              <th>Fecha</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php
            if (isset($_GET["initialDate"])) {
              $initialDate = $_GET["initialDate"];
              $finalDate = $_GET["finalDate"];
            } else {
              $initialDate = null;
              $finalDate = null;
            }

            $answer = (new ControllerSales)->ctrSalesDatesRange($initialDate, $finalDate);

            foreach ($answer as $key => $value) {
              echo '<td>' . ($key + 1) . '</td>
                  <td>' . $value["code"] . '</td>';
              $itemCustomer = "id";
              $valueCustomer = $value["idCustomer"];
              $customerAnswer = ControllerCustomers::ctrShowCustomers($itemCustomer, $valueCustomer);
              echo '<td>' . $customerAnswer["name"] . '</td>';
              $itemUser = "id";
              $valueUser = $value["idSeller"];
              $userAnswer = ControllerUsers::ctrShowUsers($itemUser, $valueUser);
              echo '<td>' . $userAnswer["name"] . '</td>
                  <td>' . $value["paymentMethod"] . '</td>
                  <td>$ ' . number_format($value["netPrice"], 2) . '</td>
                  <td>$ ' . number_format($value["totalPrice"], 2) . '</td>
                  <td>' . $value["saledate"] . '</td>
                  <td>
                    <div class="btn-group">
                      <div class="btn-group">
                      <button class="btn btn-info btnPrintBill" saleCode="' . $value["code"] . '">
                        <i class="fa fa-print"></i>
                      </button>';
              //if($_SESSION["profile"] == "Administrator"){
              echo '<button class="btn btn-warning btnEditSale" idSale="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>

                          <button class="btn btn-danger btnDeleteSale" idSale="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
              //}
              echo '</div>
                  </td>
                </tr>';
            } ?>


          </tbody>

        </table>

        <?php

        $deleteSale = new ControllerSales();
        $deleteSale->ctrDeleteSale();

        ?>

      </div>

    </div>

  </section>

</div>