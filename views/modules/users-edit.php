<?php

$user_id = $_POST["user_id"];


if (!isset($_POST["user_id"]) || empty($_POST["user_id"])) {
  echo '<script>
    window.location = "home";
  </script>';
  die();
}
$user_id = trim($_POST["user_id"]);
// Limpiar el input
$clean_user_id = htmlspecialchars(strip_tags($user_id), ENT_QUOTES, 'UTF-8');

echo "✅ ID válido y limpio: " . $clean_user_id;

$user_info = ControllerUsers::ctrShowUsers("id", $clean_user_id);
$profile_info = ProfilesModel::MdlShowUserProfile($clean_user_id);
$user_role = RolesModel::MdlShowUserRoles($clean_user_id);

?>
<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Editar Usuario y perfil usuario
    </h1>

    <ol class="breadcrumb">
      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Edit Sale</li>
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--
      =============================================
       - THE FORM
      =============================================
      -->
      <div class="col-lg-5 col-xs-12">
        <div class="box box-success">
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="saleForm">
            <div class="box-body">
              <div class="box">
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="newSeller" id="newSeller" value="<?php echo $profile_info["first_name"]; ?>">
                  </div>
                </div>
             
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" class="form-control" id="newSale" name="editSale" value="<?php echo $profile_info["last_name"]; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="newSeller" id="newSeller" value="<?php echo $profile_info["run"]; ?>">
                  </div>
                </div>
             
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="newSeller" id="newSeller" value="<?php echo $profile_info["phone_number"]; ?>">
                  </div>
                </div>
             
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="newSeller" id="newSeller" value="<?php echo $profile_info["address"]; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    <select class="form-control" name="selectCustomer" id="selectCustomer" required>
                      <?php
                      $roles = RolesModel::mdlRoles();
                      foreach ($roles as $key => $value) {
                        echo '<option value="' . $value["id"] . '">' . $value["name"] . '</option>';
                      }
                      ?>
                    </select>
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAddCustomer" data-dismiss="modal">Add Customer</button></span>
                  </div>

                </div>

               

              </div>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Save changes</button>
            </div>
          </form>

        </div>

      </div>

    </div>

  </section>

</div>


