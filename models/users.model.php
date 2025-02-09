<?php

require_once "connection.php";

class UsersModel
{

	/*=============================================
	CREATE NEW USER FROM SIGNUP
	=============================================*/
	static public function createUser($data)
	{
		$pdo = (new Connection)->connect(); // Guardamos la conexión en una variable
		$stmt = $pdo->prepare("INSERT INTO users(username, email, password, status, random) VALUES (:username, :email, :password, :status, :random)");
		$stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $data["email"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt->bindParam(":status", $data["status"], PDO::PARAM_STR);
		$stmt->bindParam(":random", $data["random"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			// Obtener la conexión y el último ID insertado
			$lastId = $pdo->lastInsertId(); // Usamos la misma conexión para obtener el ID
			// Recuperar el objeto completo con los datos insertados
			$query = $pdo->prepare("SELECT * FROM users WHERE id = :id");
			$query->bindParam(":id", $lastId, PDO::PARAM_INT);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_ASSOC); // Obtener el objeto como array asociativo
			return $result;
		} else {
			return ["error" => "No se pudo insertar el registro"];
		}
		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	SHOW USER 
	=============================================*/

	static public function MdlShowUsers($tableUsers, $item, $value)
	{

		if ($item != null) {
			
			$stmt = (new Connection)->connect()->prepare("SELECT * FROM $tableUsers WHERE $item = :$item");
			$stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		} else {
			$stmt = (new Connection)->connect()->prepare("SELECT * FROM $tableUsers");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}


	/*=============================================
	ADD USER 
	=============================================*/

	static public function mdlAddUser($table, $data)
	{

		$stmt = (new Connection)->connect()->prepare("INSERT INTO $table(name, user, password, profile, photo) VALUES (:name, :user, :password, :profile, :photo)");

		$stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
		$stmt->bindParam(":user", $data["user"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt->bindParam(":profile", $data["profile"], PDO::PARAM_STR);
		$stmt->bindParam(":photo", $data["photo"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return 'ok';
		} else {

			return 'error';
		}

		$stmt->close();

		$stmt = null;
	}


	/*=============================================
	EDIT USER 
	=============================================*/

	static public function mdlEditUser($table, $data)
	{

		$stmt = (new Connection)->connect()->prepare("UPDATE $table set name = :name, password = :password, profile = :profile, photo = :photo WHERE user = :user");

		$stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
		$stmt->bindParam(":user", $data["user"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt->bindParam(":profile", $data["profile"], PDO::PARAM_STR);
		$stmt->bindParam(":photo", $data["photo"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return 'ok';
		} else {

			return 'error';
		}

		$stmt->close();

		$stmt = null;
	}
	/*=============================================
	EDIT USER 
	=============================================*/

	static public function validateCode($data)
	{
		$stmt = (new Connection)->connect()->prepare("UPDATE users set status = 1 WHERE id = :id");
		$stmt->bindParam(":id", $data["id"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			return 'ok';
		} else {
			return 'error';
		}
		$stmt->close();
		$stmt = null;
	}


	/*=============================================
	UPDATE USER 
	=============================================*/

	static public function mdlUpdateUser($table, $item1, $value1, $item2, $value2)
	{

		$stmt = (new Connection)->connect()->prepare("UPDATE $table set $item1 = :$item1 WHERE $item2 = :$item2");
		$stmt->bindParam(":" . $item1, $value1, PDO::PARAM_STR);
		$stmt->bindParam(":" . $item2, $value2, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return 'ok';
		} else {
			return 'error';
		}

		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	UPDATE USER 
	=============================================*/

	static public function logUser($user_id, $action)
	{

		$sql = "INSERT INTO  user_logs (user_id, action) VALUES (" . $user_id . ", '" . $action . "')";

		$stmt = (new Connection)->connect()->prepare($sql);

		if ($stmt->execute()) {
			return 'ok';
		} else {
			return 'error';
		}

		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	DELETE USER 
	=============================================*/

	static public function mdlDeleteUser($table, $data)
	{

		$stmt = (new Connection)->connect()->prepare("DELETE FROM $table WHERE id = :id");
		$stmt->bindParam(":id", $data, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return 'ok';
		} else {
			return 'error';
		}

		$stmt->close();
		$stmt = null;
	}
}
