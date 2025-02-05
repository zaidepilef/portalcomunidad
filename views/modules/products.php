<?php

if($_SESSION["profile"] == "Seller"){

  echo '<script>

    window.location = "home";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administración de Consumos

    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Dashboard</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#addProduct">Agregar Consumo</button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive productsTable" width="100%">

          <thead>

           <tr>

             <th style="width:10px">#</th>
             <th>Comuna</th>
             <th>Establecimiento</th>
             <th>Categoría</th>
             <th>Año</th>
             <th>Mes</th>
             <th>Consumo [KWh]</th>
             <th>Costo Consumo [$]</th>
             <th>Fecha</th>
             <th>Acciones</th>

           </tr>

          </thead>

        </table>

        <input type="hidden" value="<?php echo $_SESSION['profile']; ?>" id="hiddenProfile">

      </div>

    </div>

  </section>

</div>

<!--=====================================
=            module add Product            =
======================================-->

<!-- Modal -->
<div id="addProduct" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/form-data">

        <!--=====================================
        HEADER
        ======================================-->

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Consumo</h4>

        </div>

        <!--=====================================
        BODY
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- input category -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="newCategory" name="newCategory">

                  <option value="">Seleccione Categoría</option>

                   <?php

                    $item = null;
                    $value1 = null;

                    $categories = controllerCategories::ctrShowCategories($item, $value1);

                    foreach ($categories as $key => $value) {

                      echo '<option value="'.$value["id"].'">'.$value["Category"].'</option>';
                    }

                  ?>

                </select>

              </div>

            </div>

            <!--Input Code Comuna -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                <input class="form-control input-lg" type="text" id="newCode" name="newCode" placeholder="Agregar comuna" required >

              </div>

            </div>

            <!-- input description Establecimiento-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-university"></i></span>

                <input class="form-control input-lg" type="text" id="newDescription" name="newDescription" placeholder="Agregar establecimiento" required>

              </div>

            </div>

             <!-- input Stock  Año-->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input class="form-control input-lg" type="number" id="newStock" name="newStock" placeholder="Agregar año" min="0" required>

              </div>

            </div>

            <!-- input Sales  Mes-->
           <div class="form-group">

             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

               <input class="form-control input-lg" type="text" id="newMonth" name="newMonth" placeholder="Agregar mes" required>

             </div>

           </div>

            <!-- INPUT BUYING PRICE -->
            <div class="form-group row">

              <div class="col-xs-12 col-sm-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" id="newBuyingPrice" name="newBuyingPrice" step="any" min="0" placeholder="Consumo en KWh" required>

                </div>

              </div>

              <!-- INPUT SELLING PRICE -->
              <div class="col-xs-12 col-sm-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number" class="form-control input-lg" id="newSellingPrice" name="newSellingPrice" step="any" min="0" placeholder="Costo consumo en $" required>

                </div>

                <br>

                <!-- CHECKBOX PERCENTAGE
                <div class="col-xs-6">

                  <div class="form-group">

                    <label>

                      <input type="checkbox" class="minimal percentage" checked>

                      Use percentage

                    </label>

                  </div>

                </div>-->

                <!-- INPUT PERCENTAGE
                <div class="col-xs-6" style="padding:0">

                  <div class="input-group">

                    <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>

                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                  </div>

                </div>-->

              </div>

            </div>

            <!-- input image
            <div class="form-group">

              <div class="panel">Upload image</div>

              <input id="newProdPhoto" type="file" class="newImage" name="newProdPhoto">

              <p class="help-block">Maximum size 2Mb</p>

              <img src="views/img/products/default/anonymous.png" class="img-thumbnail preview" alt="" width="100px">

            </div>-->

          </div>

        </div>

        <!--=====================================
        FOOTER
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary">Grabar Consumo</button>

        </div>

      </form>

      <?php

          $createProduct = new ControllerProducts();
          $createProduct -> ctrCreateProducts();

        ?>
    </div>

  </div>

</div>

<!--====  End of module add Product  ====-->
<!--=====================================
EDIT PRODUCT
======================================-->

<div id="modalEditProduct" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        HEADER
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modificar Consumo</h4>
        </div>

        <!--=====================================
         BODY
        ======================================-->

        <div class="modal-body">
          <div class="box-body">
            <!-- Select Category -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select class="form-control input-lg" name="editCategory" required>
                  <option id="editCategory"></option>
                </select>
              </div>
            </div>

            <!-- INPUT FOR THE CODE -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <!--<input type="text" class="form-control input-lg" id="editCode" name="editCode" readonly required>-->
                <input type="text" class="form-control input-lg" id="editCode" name="editCode"  required>
              </div>

            </div>

            <!-- INPUT FOR THE DESCRIPTION -->
          <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-university"></i></span>

                <input type="text" class="form-control input-lg" id="editDescription" name="editDescription" required>

              </div>

            </div>

             <!-- INPUT FOR THE STOCK  (AÑO)-->
             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="number" class="form-control input-lg" id="editStock" name="editStock" min="0" required>

              </div>

            </div>

            <!-- input image (Mes)-->
           <div class="form-group">

             <div class="input-group">

               <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

               <input type="text" class="form-control input-lg" id="editMonth" name="editMonth" required>

             </div>

           </div>
             <!-- INPUT FOR BUYING PRICE -->
             <div class="form-group row">

                <div class="col-xs-12 col-sm-6">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                    <input type="number" class="form-control input-lg" id="editBuyingPrice" name="editBuyingPrice" step="any" min="0" required>

                  </div>

                </div>

                <!-- INPUT FOR SELLING PRICE -->
                <div class="col-xs-12 col-sm-6">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                    <input type="number" class="form-control input-lg" id="editSellingPrice" name="editSellingPrice" step="any" min="0" readonly required>

                  </div>



                  <!-- PERCENTAGE CHECKBOX
                  <div class="col-xs-6">

                    <div class="form-group">

                      <label>

                        <input type="checkbox" class="minimal percentage" checked>

                        Use Percentage

                      </label>

                    </div>

                  </div>-->

                  <!-- INPUT FOR PORCENTAJE
                  <div class="col-xs-6" style="padding:0">

                    <div class="input-group">

                      <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>-->

                </div>

            </div>

            <!-- INPUT TO UPLOAD IMAGE
             <div class="form-group">

              <div class="panel">Upload Image</div>

              <input type="file" class="newImage" name="editImage">

              <p class="help-block">2MB max</p>

              <img src="views/img/products/default/anonymous.png" class="img-thumbnail preview" width="100px">

              <input type="hidden" name="currentImage" id="currentImage">

            </div>-->

          </div>

        </div>

        <!--=====================================
        FOOTER
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>

          <button type="submit" class="btn btn-primary">Grabar Cambios</button>

        </div>

      </form>

        <?php

          $editProduct = new controllerProducts();
          $editProduct -> ctrEditProduct();

        ?>

    </div>

  </div>

</div>

<?php

  $deleteProduct = new controllerProducts();
  $deleteProduct -> ctrDeleteProduct();

?>
