<?php


require_once "connection.php";

class CategoriesModel
{

	/*=============================================
	CREATE CATEGORY
	=============================================*/

	static public function mdlAddCategory($table, $data)
	{
		$pdo = (new Connection)->connect(); // Guardamos la conexión en una variable

		$stmt = $pdo->prepare("INSERT INTO $table(name,description,prorateo_type) VALUES (:name,:description,:prorateo_type)");
		$stmt->bindParam(":name", $data['name'], PDO::PARAM_STR);
		$stmt->bindParam(":description", $data['description'], PDO::PARAM_STR);
		$stmt->bindParam(":prorateo_type", $data['prorateo_type'], PDO::PARAM_STR);

		if ($stmt->execute()) {
			// Obtener la conexión y el último ID insertado
			$lastId = $pdo->lastInsertId(); // Usamos la misma conexión para obtener el ID
			// Recuperar el objeto completo con los datos insertados
			$query = $pdo->prepare("SELECT * FROM $table WHERE id = :id");
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

	/*
	=============================================
	SHOW CATEGORY 
	=============================================
	*/

	static public function mdlShowCategories($table, $item, $value)
	{
		if ($item != null) {
			$stmt = (new Connection)->connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
			$stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		} else {
			$stmt = (new Connection)->connect()->prepare("SELECT * FROM $table");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		$stmt->close();
		$stmt = null;
	}

	/*
	=============================================
	EDIT CATEGORY
	=============================================
	*/
	static public function mdlEditCategory($table, $data)
	{
		$stmt = (new Connection)->connect()->prepare("UPDATE $table SET name = :name, description = :description, prorateo_type = :prorateo_type WHERE id = :id");
		$stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
		$stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
		$stmt->bindParam(":description", $data["description"], PDO::PARAM_STR);
		$stmt->bindParam(":prorateo_type", $data["prorateo_type"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
		$stmt->close();
		$stmt = null;
	}

	/*
	=============================================
	DELETE CATEGORY
	=============================================
	*/

	static public function mdlDeleteCategory($table, $data)
	{

		$stmt = (new Connection)->connect()->prepare("DELETE FROM $table WHERE id = :id");

		$stmt->bindParam(":id", $data, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}
}
