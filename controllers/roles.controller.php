<?php

class ControllerRoles
{

	/*=============================================
	CREAR ROL de USURIO 
	=============================================*/

	static public function ctrCreateUserRole($user_id, $role_id)
	{
		// INSERT INTO user_roles (user_id, role_id) VALUES (1, 1), -- Usuario 1 es Administrador
		$sql = "INSERT INTO user_role (user_id, role_id) VALUES (:user_id, :role_id)";
		$stmt = (new Connection)->connect()->prepare($sql);
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":role_id", $role_id, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return 'ok';
		} else {
			return 'error';
		}

		$stmt->close();
		$stmt = null;
	}


}
