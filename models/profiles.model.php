<?php

require_once "connection.php";

class ProfilesModel
{

	/*=============================================
	SHOW PROFILE 
	=============================================*/

	static public function MdlShowUserProfile($userId)
	{
		try {
			$sql = "SELECT * FROM profiles WHERE user_id = " . $userId;
			$stmt = (new Connection)->connect()->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
			if (!$result) {
				return false; // Usuario no encontrado
			}
			return $result;
		} catch (PDOException $e) {
			return false; // Error en la consulta
		}
	}
}
