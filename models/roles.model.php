<?php

require_once "connection.php";

class RolesModel
{


	/*
	=============================================
	MOSTRAR TODOS LOS ROLES
	=============================================
	*/
	static public function mdlRoles()
	{
		$sql = "SELECT * FROM roles";
		$stmt = (new Connection)->connect()->prepare($sql);
		if ($stmt->execute()) {
			return $stmt->fetchAll();
			$stmt->close();
			$stmt = null;
		} else {
			return "error";
		}
	}


	/*
	=============================================
	SHOW PROFILE 
	=============================================
	*/
	static public function MdlShowUserRoles($user_id)
	{
		$sql = "SELECT r.name, r.id FROM user_roles ur JOIN roles r ON ur.role_id = r.id WHERE ur.user_id = " . $user_id;
		$stmt = (new Connection)->connect()->prepare($sql);
		if ($stmt->execute()) {
			return $stmt->fetchAll();
			$stmt->close();
			$stmt = null;
		} else {
			return "error";
		}
	}


	/*
	=============================================
	CREAR ROL de USUARIO 
	=============================================
	*/
	static public function ctrCreateUserRole($user_id, $role_id)
	{
		// INSERT INTO user_roles (user_id, role_id) VALUES (1, 1), -- Usuario 1 es Administrador
		$sql = "INSERT INTO user_roles (user_id, role_id) VALUES (:user_id, :role_id)";
		$stmt = (new Connection)->connect()->prepare($sql);
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->bindParam(":role_id", $role_id, PDO::PARAM_INT);
		if ($stmt->execute()) {
			return 'ok';
		} else {
			return 'error';
		}
		$stmt->close();
		$stmt = null;
	}
}
