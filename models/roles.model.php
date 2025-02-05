<?php

require_once "connection.php";

class RolesModel
{

	/*=============================================
	SHOW PROFILE 
	=============================================*/

	static public function MdlShowUserRoles($userId)
	{
		$sql = "SELECT r.name, r.id FROM user_roles ur JOIN roles r ON ur.role_id = r.id WHERE ur.user_id = " . $userId;
		print_r($sql);
		

		$stmt = (new Connection)->connect()->prepare($sql);

		if ($stmt->execute()) {

			return $stmt->fetchAll();

			$stmt->close();

			$stmt = null;
		} else {

			return "error";
		}

	}
}
