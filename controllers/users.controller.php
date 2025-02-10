<?php

class ControllerUsers
{

	/*=============================================
	USER LOGIN
	=============================================*/

	static public function ctrUserLogin()
	{

		if (isset($_POST["loginUser"])) {

			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginUser"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginPass"])) {
				
				$salt = "automovil"; // Usa un salt único para cada usuario
				$encryptpass = hash('sha256', $salt . $_POST["loginPass"]);
				$table = 'users';
				$item = 'username';
				$value = $_POST["loginUser"];
				$answer = UsersModel::MdlShowUsers($table, $item, $value);

				if (!$answer) {
					echo '<br><div class="alert alert-danger">Usuario no existe</div>';
				} else {
					if ($answer["username"] == $_POST["loginUser"]) {
						$user_id = $answer["id"];
						
						if ($answer["password"] == $encryptpass) {
							$profile = ProfilesModel::MdlShowUserProfile($user_id);
							$rolesUser = RolesModel::MdlShowUserRoles($user_id);
							if ($answer["status"] == 1) {
								$_SESSION["loggedIn"] = "ok";
								$_SESSION["id"] = $answer["id"];
								$_SESSION["username"] = $answer["username"];
								$_SESSION["email"] = $answer["email"];
								$_SESSION["status"] = $answer["status"];
								$_SESSION["first_name"] = $profile["first_name"];
								$_SESSION["last_name"] = $profile["last_name"];
								$_SESSION["photo"] = $profile["photo"];
								$_SESSION["roles_user"] = $rolesUser;


								$roleassign = ControllerRoles::ctrCreateUserRole($user_id,2);
								$lastLogin = UsersModel::logUser($answer["id"], "Usuario válido ingresa a sistema.");
								if ($lastLogin == "ok") {
									echo '<script>window.location = "home";</script>';
								}
							} else {
								$lastLogin = UsersModel::logUser($answer["id"], "Usuario no activo intenta ingresar");
								echo '<br><div class="alert alert-danger">Usuario no se encuentra en periodo de validacion</div>';
							}
						} else {
							$lastLogin = UsersModel::logUser($answer["id"], "Usuario o password incorrectos");
							echo '<br><div class="alert alert-danger">Usuario o password incorrectos</div>';
						}
					} else {
						echo '<br><div class="alert alert-danger">Usuario o password incorrectos</div>';
					}
				}
			}
		}
	}


	/*=============================================
	CREATE USER
	=============================================*/

	static public function ctrCreateUser()
	{

		if (isset($_POST["newUser"])) {

			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newName"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["newUser"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPasswd"])
			) {

				/*=============================================
				VALIDATE IMAGE
				=============================================*/

				$photo = "";

				if (isset($_FILES["newPhoto"]["tmp_name"])) {

					list($width, $height) = getimagesize($_FILES["newPhoto"]["tmp_name"]);

					$newWidth = 500;
					$newHeight = 500;

					/*=============================================
					Let's create the folder for each user
					=============================================*/

					$folder = "views/img/users/" . $_POST["newUser"];

					mkdir($folder, 0755);

					/*=============================================
					PHP functions depending on the image
					=============================================*/

					if ($_FILES["newPhoto"]["type"] == "image/jpeg") {

						$randomNumber = mt_rand(100, 999);

						$photo = "views/img/users/" . $_POST["newUser"] . "/" . $randomNumber . ".jpg";

						$srcImage = imagecreatefromjpeg($_FILES["newPhoto"]["tmp_name"]);

						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagejpeg($destination, $photo);
					}

					if ($_FILES["newPhoto"]["type"] == "image/png") {

						$randomNumber = mt_rand(100, 999);

						$photo = "views/img/users/" . $_POST["newUser"] . "/" . $randomNumber . ".png";

						$srcImage = imagecreatefrompng($_FILES["newPhoto"]["tmp_name"]);

						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagepng($destination, $photo);
					}
				}

				$table = 'users';

				$salt = "automovil"; // Usa un salt único para cada usuario
				$encryptpass = hash('sha256', $salt . $_POST["newPasswd"]);

				$data = array(
					'name' => $_POST["newName"],
					'user' => $_POST["newUser"],
					'password' => $encryptpass,
					'profile' => $_POST["newProfile"],
					'photo' => $photo
				);

				$answer = UsersModel::mdlAddUser($table, $data);

				if ($answer == 'ok') {
					$a = UsersModel::logUser($_SESSION["id"], "Crea registro de un nuevo usuario en el sistema");
					$b = UsersModel::logUser($answer["id"], "Se crea usuario en base,a la espera validacion");

					echo '<script>

						swal({
							type: "success",
							title: "Usuario Creado!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){

								window.location = "users";
							}

						});

						</script>';
				}
			} else {

				echo '<script>

					swal({
						type: "error",
						title: "No se permiten caracteres especiales o espacios blancos",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){

								window.location = "users";
							}

						});

				</script>';
			}
		}
	}


	/*=============================================
	Mostrar usurios
	=============================================*/

	static public function ctrUsuarios()
	{
		$answer = UsersModel::MdlMostarUsuarios();
		return $answer;
	}

	/*=============================================
	SHOW USER
	=============================================*/

	static public function ctrShowUsers($item, $value)
	{

		$table = "users";

		$answer = UsersModel::MdlShowUsers($table, $item, $value);

		return $answer;
	}

	/*=============================================
	EDIT USER
	=============================================*/

	static public function ctrEditUser()
	{

		if (isset($_POST["EditUser"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditName"])) {

				/*=============================================
				VALIDATE IMAGE
				=============================================*/

				$photo = $_POST["currentPicture"];

				if (isset($_FILES["editPhoto"]["tmp_name"]) && !empty($_FILES["editPhoto"]["tmp_name"])) {

					list($width, $height) = getimagesize($_FILES["editPhoto"]["tmp_name"]);

					$newWidth = 500;
					$newHeight = 500;

					/*=============================================
					Let's create the folder for each user
					=============================================*/

					$folder = "views/img/users/" . $_POST["EditUser"];

					/*=============================================
					we ask first if there's an existing image in the database
					=============================================*/

					if (!empty($_POST["currentPicture"])) {

						unlink($_POST["currentPicture"]);
					} else {

						mkdir($folder);
					}

					/*=============================================
					PHP functions depending on the image
					=============================================*/

					if ($_FILES["editPhoto"]["type"] == "image/jpeg") {

						/*We save the image in the folder*/

						$randomNumber = mt_rand(100, 999);

						$photo = "views/img/users/" . $_POST["EditUser"] . "/" . $randomNumber . ".jpg";

						$srcImage = imagecreatefromjpeg($_FILES["editPhoto"]["tmp_name"]);

						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagejpeg($destination, $photo);
					}

					if ($_FILES["editPhoto"]["type"] == "image/png") {

						/*We save the image in the folder*/

						$randomNumber = mt_rand(100, 999);

						$photo = "views/img/users/" . $_POST["EditUser"] . "/" . $randomNumber . ".png";

						$srcImage = imagecreatefrompng($_FILES["editPhoto"]["tmp_name"]);

						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagepng($destination, $photo);
					}
				}


				$table = 'users';

				if ($_POST["EditPasswd"] != "") {

					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["EditPasswd"])) {

						$encryptpass = crypt($_POST["EditPasswd"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					} else {

						echo '<script>

							swal({
								type: "error",
								title: "No especial characters in the password or blank fields",
								showConfirmButton: true,
								confirmButtonText: "Close"

								}).then(function(result){

									if (result.value) {

										window.location = "users";

									}
								});

						</script>';
					}
				} else {

					$encryptpass = $_POST["currentPasswd"];
				}

				$data = array(
					'name' => $_POST["EditName"],
					'user' => $_POST["EditUser"],
					'password' => $encryptpass,
					'profile' => $_POST["EditProfile"],
					'photo' => $photo
				);

				$answer = UsersModel::mdlEditUser($table, $data);

				if ($answer == 'ok') {

					echo '<script>

						swal({
							type: "success",
							title: "¡User edited succesfully!",
							showConfirmButton: true,
							confirmButtonText: "Close"

						 }).then(function(result){

							if (result.value) {

								window.location = "users";
							}

						});

					</script>';
				} else {
					echo '<script>

						swal({
							type: "error",
							title: "No especial characters in the name or blank field",
							showConfirmButton: true,
							confirmButtonText: "Close"
							 }).then(function(result){

								if (result.value) {

									window.location = "users";

								}

							});

					</script>';
				}
			}
		}
	}

	/*=============================================
	DELETE USER
	=============================================*/

	static public function ctrDeleteUser()
	{

		if (isset($_GET["userId"])) {

			$table = "users";
			$data = $_GET["userId"];

			if ($_GET["userPhoto"] != "") {

				unlink($_GET["userPhoto"]);
				rmdir('views/img/users/' . $_GET["username"]);
			}

			$answer = UsersModel::mdlDeleteUser($table, $data);

			if ($answer == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "The user has been succesfully deleted",
					  showConfirmButton: true,
					  confirmButtonText: "Close"

					  }).then(function(result){

						if (result.value) {

						window.location = "users";

						}
					})

				</script>';
			}
		}
	}
	
}
