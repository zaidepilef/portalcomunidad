<?php

class ControllerSignUp{

	/*=============================================
	USER SIGNUP
	=============================================*/

	static public function ctrUserSignUp(){

		if (
			isset( $_POST["signupUsername"]) && 
			isset( $_POST["signupEmail"]) && 
			isset( $_POST["signupPass"]) && 
			isset( $_POST["signupRepass"])
		) {
			if(!preg_match('/^[a-zA-Z0-9]+$/', $_POST["signupUsername"])){
				echo '<br><div class="alert alert-danger">Nombre Usuario no valido</div>';
				exit;
			}
			
			if( !preg_match('/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,}$/', $_POST["signupEmail"]) ){
				echo '<br><div class="alert alert-danger">Email no valido</div>';
				exit;
			}

			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["signupUsername"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginPass"]) ) {

				$encryptpass = crypt($_POST["signupPass"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$table = 'users';

				$item = 'user';
				$value = $_POST["loginUser"];

				$answer = UsersModel::MdlShowUsers($table, $item, $value);

			// var_dump($answer);

				if($answer["user"] == $_POST["loginUser"] && $answer["password"] == $encryptpass){

					if($answer["status"] == 1){

						$_SESSION["loggedIn"] = "ok";
						$_SESSION["id"] = $answer["id"];
						$_SESSION["name"] = $answer["name"];
						$_SESSION["user"] = $answer["user"];
						$_SESSION["photo"] = $answer["photo"];
						$_SESSION["profile"] = $answer["profile"];

						/*=============================================
						Register date to know last_login
						=============================================*/

						date_default_timezone_set("America/Santiago");

						$date = date('Y-m-d');
						$hour = date('H:i:s');

						$actualDate = $date.' '.$hour;

						$item1 = "lastLogin";
						$value1 = $actualDate;

						$item2 = "id";
						$value2 = $answer["id"];

						$lastLogin = UsersModel::mdlUpdateUser($table, $item1, $value1, $item2, $value2);

						if($lastLogin == "ok"){

							echo '<script>

								window.location = "home";

							</script>';

						}

					}else{

						echo '<br><div class="alert alert-danger">User is deactivated</div>';

					}

				}else{

					echo '<br><div class="alert alert-danger">User or password incorrect</div>';

				}

			}

		}

	}


}
