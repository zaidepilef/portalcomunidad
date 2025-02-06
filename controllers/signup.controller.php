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
			$encryptpass = crypt($pass, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			$data = array(
				"username" => $username,
				"email" => $email,
				"password" => $encryptpass,
				"status" => 0
			);
			//var_dump("data : ", $data);

			$newuser = UsersModel::createUser($data);

			if (isset($newuser['error'])) {
				echo '<br><div class="alert alert-danger">' . $newuser['error'] . '</div>';
				exit;
			} else {

				$_SESSION["username"] = $newuser["username"];
				$_SESSION["email"] = $newuser["email"];
				$_SESSION["status"] = $newuser["status"];
				
				echo '<script>window.location = "postsignup";</script>';
				exit;
			}
		}
	}
}
