
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Product management

    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Dashboard</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#addProduct">

          Add Product

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tables" width="100%">
       
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>
             <th>Image</th>
             <th>Code</th>
             <th>Description</th>
             <th>Category</th>
             <th>Stock</th>
             <th>Buying price</th>
             <th>Selling Price</th>
             <th>Date added</th>
             <th>Actions</th>

           </tr> 

          </thead>

          <tbody>

              <tr>
                <td>1</td>
                <td><img src="views/img/products/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <td>0001</td>
                <td>Lorem Ipsum dolor sit</td>
                <td>Drills</td>
                <td>20</td>
                <td>$5.00</td>
                <td>$10.00</td>
                <td>2017-12-11 12:05:32</td>
                <td>

                  <div class="btn-group">
                      
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                  </div>  

                </td>

              </tr>

              <tr>
                <td>1</td>
                <td><img src="views/img/products/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                <td>0001</td>
                <td>Lorem Ipsum dolor sit</td>
                <td>Drills</td>
                <td>20</td>
                <td>$5.00</td>
                <td>$10.00</td>
                <td>2017-12-11 12:05:32</td>
                <td>

                  <div class="btn-group">
                      
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>

                  </div>  

                </td>

              </tr>
            
          </tbody>

        </table>

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

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/formdata">

        <!--=====================================
        HEADER
        ======================================-->

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Add Product</h4>

        </div>

        <!--=====================================
        BODY
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!--Input Code -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input class="form-control input-lg" type="text" name="newCode" placeholder="Add Code" required>

              </div>

            </div>

            <!-- input description -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input class="form-control input-lg" type="text" name="newDescription" placeholder="Add Description" required>

              </div>

            </div>

            <!-- input category -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" name="newCategory">

                  <option value="">Select Category</option>
                  <option value="drills">Drills</option>
                  <option value="scaffold">Scaffold</option>
                  <option value="construction">Construction materials</option>

                </select>

              </div>

            </div>

             <!-- input Stock -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input class="form-control input-lg" type="number" name="newStock" placeholder="Add Stock" min="0" required>

              </div>

            </div>

             <!-- INPUT BUYING PRICE -->
             <div class="form-group row">

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="newBuyingPrice" name="newBuyingPrice" step="any" min="0" placeholder="Buying price" required>

                  </div>

                </div>

                <!-- INPUT SELLING PRICE -->
                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="newSellingPrice" name="newSellingPrice" step="any" min="0" placeholder="Selling price" required>

                  </div>
                
                  <br>

                  <!-- CHECKBOX PERCENTAGE -->
                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal percentage" checked>
                        
                        Use percentage
                      
                      </label>

                    </div>

                  </div>

                  <!-- INPUT PERCENTAGE -->
                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

            </div>

            <!-- input image -->
            <div class="form-group">

              <div class="panel">Upload image</div>

              <input id="newProdPhoto" type="file" name="newProdPhoto">

              <p class="help-block">Maximum size 2Mb</p>

              <img src="views/img/products/default/anonymous.png" alt="" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        FOOTER
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Save product</button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--====  End of module add Product  ====-->
