<?php

class ControllerSignUp
{

	/*=============================================
	USER SIGNUP
	=============================================*/

	static public function ctrUserSignUp()
	{

		if (
			isset($_POST["signupUsername"]) &&
			isset($_POST["signupEmail"]) &&
			isset($_POST["signupPass"]) &&
			isset($_POST["signupRepass"])
		) {

			$_username = $_POST["signupUsername"];
			$username = trim($_username);

			$_email = $_POST["signupEmail"];
			$email = trim($_email);

			$_pass = $_POST["signupPass"];
			$pass = trim($_pass);

			$_repass = $_POST["signupRepass"];
			$repass = trim($_repass);

			if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
				echo '<br><div class="alert alert-danger">Nombre Usuario no valido</div>';
				exit;
			}

			if (!preg_match('/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,}$/', $email)) {
				echo '<br><div class="alert alert-danger">Email no valido</div>';
				exit;
			}


			if ($pass !== $repass) {
				echo '<br><div class="alert alert-danger">Error en la password</div>';
				exit;
			}

			$answer_username = UsersModel::MdlShowUsers('users', 'username', $username);
			$answer_email = UsersModel::MdlShowUsers('users', 'email', $email);

			//var_dump("answer_username : ", $answer_username);
			if ($answer_username) {
				echo '<br><div class="alert alert-danger">Usuario ya existe</div>';
				exit;
			}

			//var_dump("answer_email : ", $answer_email);
			if ($answer_email) {
				echo '<br><div class="alert alert-danger">Correo ya se encuentra registrado</div>';
				exit;
			}

			$salt = "automovil"; // Usa un salt único para cada usuario
			$encryptpass = hash('sha256', $salt . $pass);
			$random = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
			$data = array(
				"username" => $username,
				"email" => $email,
				"password" => $encryptpass,
				"random" => $random,
				"status" => 0
			);
			//var_dump("data : ", $data);

			$newuser = UsersModel::createUser($data);

			if (isset($newuser['error'])) {
				echo '<br><div class="alert alert-danger">' . $newuser['error'] . '</div>';
				exit;
			} else {
				$roleassign = RolesModel::ctrCreateUserRole($newuser["id"],2);
				$_SESSION["username"] = $newuser["username"];
				$_SESSION["email"] = $newuser["email"];
				$_SESSION["status"] = $newuser["status"];
				//$mailer = HelperMailer::firtMailer($newuser);

				echo '<script>window.location = "postsignup";</script>';
				exit;
			}
		}
	}


	/*=============================================
	VALIDATE USER
	=============================================*/

	static public function validateCodeUser()
	{
		//echo "public function validateCodeUser()";
		if (isset($_POST["validateEmail"]) && isset($_POST["validateCode"])) {
			
			//echo "if (isset(_POST[validateEmail]) && isset(_POST[validateCode]))";
			print_r($_POST);

			$_email = $_POST["validateEmail"];
			$email = trim($_email);

			$_code = $_POST["validateCode"];
			$code = trim($_code);

			if (!preg_match('/^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,}$/', $email)) {
				echo '<br><div class="alert alert-danger">Email no valido</div>';
				exit;
			}

			if (!preg_match('/^[A-Z0-9]{6}$/', $code)) {
				echo '<br><div class="alert alert-danger">Codigo debe ser de 6 digitos alfanumerico en mayusculas</div>';
				exit;
			}

			$answer_user = UsersModel::MdlShowUsers('users', 'email', $email);

			//print_r($answer_user);

			if (!$answer_user) {
				echo '<br><div class="alert alert-danger">Usuario no existe</div>';
			} else {
				if ($answer_user["random"] === $code) {
					UsersModel::validateCode($answer_user);
					UsersModel::logUser($answer_user["id"], "Validacion de registro");
				} else {
					echo '<br><div class="alert alert-danger">Codigo invalido</div>';
				}
			}
			
		}
	}
}
