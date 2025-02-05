<?php

$item = null;
$value = null;
$order = "id";

$sales = (new ControllerSales)->ctrAddingTotalSales();

$categories = ControllerCategories::ctrShowCategories($item, $value);
$totalCategories = count($categories);

$customers = ControllerCustomers::ctrShowCustomers($item, $value);
$totalCustomers = count($customers);

$products = ControllerProducts::ctrShowProducts($item, $value, $order);
$totalProducts = count($products);


?>



<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">

    <div class="inner">

      <h3>$ <?php echo number_format($sales["total"],2); ?></h3>

      <p>Total Costos Energía</p>

    </div>

    <div class="icon">

      <i class="ion ion-social-usd"></i>

    </div>

    <!--<a href="sales" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>-->

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-orange">

    <div class="inner">

      <h3>KWh <?php echo number_format($sales["total"],2); ?></h3>

      <p>Total Consumos Energía</p>

    </div>

    <div class="icon">

      <i class="ion ion-clipboard"></i>

    </div>

  <!--<a href="sales" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>-->

  </div>

</div>
<div class="col-lg-2 col-xs-6">

  <div class="small-box bg-green">

    <div class="inner">

      <h3><?php echo number_format($totalCategories); ?></h3>

      <p>Categorias</p>

    </div>

    <div class="icon">

      <i class="ion ion-android-apps"></i>


    </div>

  <!--  <a href="categories" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>-->

  </div>

</div>

<!--<div class="col-lg-2 col-xs-6">

  <div class="small-box bg-yellow">

    <div class="inner">

      <h3> <?php //echo number_format($totalCustomers); ?></h3>

      <p>Establecimientos</p>

    </div>

    <div class="icon">

      <i class="ion ion-android-home"></i>

    </div>

    <a href="customers" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>-->

<div class="col-lg-2 col-xs-6">

  <div class="small-box bg-red">

    <div class="inner">

      <h3><?php echo number_format($totalProducts); ?></h3>

      <p>Consumos</p>

    </div>

    <div class="icon">

      <i class="ion ion-drag"></i>

    </div>

  <!--  <a href="products" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>-->

  </div>

</div>
