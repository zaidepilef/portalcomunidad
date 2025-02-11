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
	MOSTRAR ROLES DISPONIBLES PARA ASIGNAR
	=============================================
	*/
	static public function mdlRolesDisponibles($user_id)
	{
		$sql = "SELECT r.id, r.name, r.description 
		FROM roles r
		LEFT JOIN user_roles ur 
		ON r.id = ur.role_id 
		AND ur.user_id = $user_id -- Cambia el ID del usuario aquí
		WHERE ur.user_id IS NULL";
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
	 - SHOW ROLES USER 
	=============================================
	*/
	static public function MdlShowUserRoles($user_id)
	{
		$sql = "SELECT r.name, r.id as role_id FROM user_roles ur JOIN roles r ON ur.role_id = r.id WHERE ur.user_id = " . $user_id;
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
	 - CREAR ROLES USER
	=============================================
	*/
	static public function mdlCreateUserRole($user_id, $role_id)
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

	/*
	=============================================
	 - ELIMINAR ROLES USER
	=============================================
	*/
	static public function mdlDeleteRoleUser($user_id, $role_id)
	{
		try {
			$stmt = (new Connection)->connect()->prepare("DELETE FROM user_roles WHERE user_id = :user_id AND role_id = :role_id");
			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
			$stmt->bindParam(":role_id", $role_id, PDO::PARAM_INT);
	
			if ($stmt->execute()) {
				return ["status" => "success", "message" => "Rol eliminado correctamente"];
			} else {
				return ["error" => "No se pudo eliminar el rol"];
			}
		} catch (PDOException $e) {
			return ["error" => "Error en SQL: " . $e->getMessage()];
		}
	}
}
