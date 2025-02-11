<?php

if (!isset($_POST["user_id"]) || empty($_POST["user_id"])) {
  echo '<script>
  window.location = "home";
  </script>';
  die();
}
$_user_id = $_POST["user_id"];
$user_id = trim($_user_id);
// Limpiar el input
$clean_user_id = htmlspecialchars(strip_tags($user_id), ENT_QUOTES, 'UTF-8');
$user_info = ControllerUsers::ctrShowUsers("id", $clean_user_id);
$profile_info = ProfilesModel::MdlShowUserProfile($clean_user_id);
$user_role = RolesModel::MdlShowUserRoles($clean_user_id);
$roles = RolesModel::mdlRoles();
$roles_disponibles = RolesModel::mdlRolesDisponibles($clean_user_id);

if (!$profile_info) {
  echo '<script>
  </script>';
}
$first_name = isset($profile_info["first_name"]) ? $profile_info["first_name"] : "";
$last_name = isset($profile_info["last_name"]) ? $profile_info["last_name"] : "";
$run = isset($profile_info["run"]) ? $profile_info["run"] : "";
$phone_number = isset($profile_info["phone_number"]) ? $profile_info["phone_number"] : "";
$address = isset($profile_info["address"]) ? $profile_info["address"] : "";

?>

<div class="content-wrapper">

  <section class="content-header">
    <h1>Editar Usuario y perfil usuario</h1>

    <ol class="breadcrumb">
      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Perfil de usuario</li>
      <li class="active">Perfil de usuario</li>
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--
      =============================================
       - THE FORM
      =============================================
      -->
      <div class="col-lg-8 col-xs-12">
        <div class="box box-success">
          <form role="form" method="post" class="saleForm">
            <div class="box">
              <div class="box-body">

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo $first_name; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $last_name; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="run" id="run" value="<?php echo $run; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="phone_number" id="phone_number" value="<?php echo $phone_number; ?>">
                  </div>
                </div>

                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" name="address" id="address" value="<?php echo $address; ?>">
                  </div>
                </div>

              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Save changes</button>
              </div>
            </div>

          </form>
        </div>
      </div>

      <div class="col-lg-4 col-xs-12">
        <div class="box box-success">

          <div class="box-header with-border">
            Roles Asignados
          </div>

          <div class="box-body">
            <table class="table table-bordered tablaRoleUser table-sm" width="100%">
             
              <tbody>
                <?php

                foreach ($user_role as $key => $value) {
                  echo '<tr> 
                    <td>' . $value["name"] . '</td> 
                    <td style="width: 10px">  <span class="input-group-addon">
                      <button
                        type="button" 
                        class="btn btn-danger btn-xs btnDeleteRoleUser" 
                        role_id="' . $value["role_id"] . '" 
                        user_id="' . $clean_user_id . '">
                          <i class="fa fa-times"></i>
                        </button> </span>
                    </td> 
                  </tr>';
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="box-footer">
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control" name="selectCustomer" id="selectCustomer" required>
                  <option value="">(Selecciones Rol)</option>
                  <?php

                  foreach ($roles_disponibles as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["name"] . '</option>';
                  }
                  ?>
                </select>
                <span class="input-group-addon">
                  <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAddCustomer" data-dismiss="modal">Asignar Rol</button>
                </span>
              </div>
            </div>
          </div>

        </div>
      </div>

  </section>


</div>

<script>
  /*
  =============================================
   - DELETE ROLE USER
  =============================================
  */

  $(document).on('click', '.btnDeleteRoleUser', function() {
    alert("button");
    alert('presiona btnDeleteRoleUser')
    var user_id = $(this).attr("user_id");
    var role_id = $(this).attr("role_id");

    swal({
      title: '¿Esta seguro de elimar rola a usuario?',
      text: "If you're not you can cancel!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancel',
      confirmButtonText: 'Si, eliminar rol!'
    }).then(function(result) {
      if (result.value) {
        //window.location = "index.php?route=sales&idSale=" + idSale;
        var data = new FormData();
        data.append("user_id", user_id);
        data.append("role_id", role_id);

        $.ajax({
          url: "ajax/users.ajax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function(answer) {
            console.log("Respuesta recibida:", answer);
            // Recargar la página después de 1 segundo
            setTimeout(function() {
              window.location.reload();
            }, 1000);
          },
          error: function(xhr, status, error) {
            console.log("❌ Error en la petición AJAX:");
            console.log("Estado:", status);
            console.log("Error:", error);
            console.log("Respuesta del servidor:", xhr.responseText);
          }
        });
      }

    })
  });
</script>