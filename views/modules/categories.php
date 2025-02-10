<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Administración de Categorías
    </h1>
    <ol class="breadcrumb">
      <li><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addCategories">Agregar Categoria</button>

      </div>
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tables" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Tipo Prorrateo</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>
            <?php

            $item = null;
            $value = null;

            $categories = ControllerCategories::ctrShowCategories($item, $value);

            // var_dump($categories);

            foreach ($categories as $key => $value) {

              echo '<tr>
                          <td>' . ($key + 1) . '</td>
                          <td class="text-uppercase">' . $value['name'] . '</td>
                          <td class="text-uppercase">' . $value['description'] . '</td>
                          <td class="text-uppercase">' . $value['prorateo_type'] . '</td>
                          <td>

                            <div class="btn-group">

                              <button class="btn btn-warning btnEditCategory" idCategory="' . $value["id"] . '" data-toggle="modal" data-target="#editCategories"><i class="fa fa-pencil"></i></button>

                              <button class="btn btn-danger btnDeleteCategory" idCategory="' . $value["id"] . '"><i class="fa fa-times"></i></button>

                            </div>

                          </td>

                        </tr>';
            }

            ?>

          </tbody>

        </table>



      </div>

    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>


<!--=====================================
=            module add Categories            =
======================================-->

<!-- Modal -->
<div id="addCategories" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="POST">
        
        <div class="modal-header" style="background: #3c8dbc; color: #fff">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Categoría</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <!--Input name -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input class="form-control input-lg" type="text" name="newCategoryName" placeholder="Agregar Categoría" required>
              </div>
            </div>

            <!--Input name -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input class="form-control input-lg" type="text" name="newCategoryDecription" placeholder="Agregar Categoría" required>
              </div>
            </div>
            <!-- input profile -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                <select class="form-control input-lg" name="newCategoryProrateo">
                  <option value="">Seleccionar Tipo</option>
                  <option value="Equitativo">Equitativo</option>
                  <option value="Asignado">Asignado</option>
                </select>
              </div>

            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar Categoría</button>
        </div>
      </form>
    </div>

  </div>
</div>

<?php

$createCategory = new ControllerCategories();
$createCategory->ctrCreateCategory();
?>


<!--=====================================
=            module edit Categories            =
======================================-->

<!-- Modal -->
<div id="editCategories" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="POST">

        <input type="hidden" name="idCategory" id="idCategory" required>

        <div class="modal-header" style="background: #3c8dbc; color: #fff">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modificar Categorias</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <!--Input name -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input class="form-control input-lg" type="text" id="editName" name="editName" required>
              </div>
            </div>

            <!--Input description -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input class="form-control input-lg" type="text" id="editDescription" name="editDescription" required>
              </div>
            </div>

            <!--Input prorateo_type -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <select class="form-control input-lg" name="editProrateoType">

                  <option value="" id="editProrateoType"></option>
                  <option value="EQUITATIVO">EQUITATIVO</option>
                  <option value="ASIGNADO">ASIGNADO</option>
                </select>
              </div>
            </div>



          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Grabar Cambios</button>
        </div>

        <?php

        $editCategory = new ControllerCategories();
        $editCategory->ctrEditCategory();
        ?>
      </form>
    </div>

  </div>
</div>

<?php

$deleteCategory = new ControllerCategories();
$deleteCategory->ctrDeleteCategory();
?>