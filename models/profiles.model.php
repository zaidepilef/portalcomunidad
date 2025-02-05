<?php

require_once "connection.php";

class ProfilesModel
{

	/*=============================================
	SHOW PROFILE 
	=============================================*/

	static public function MdlShowUserProfile($userId)
	{
		$sql = "SELECT * FROM profiles WHERE user_id = " . $userId;
		print_r($sql);
		

		$stmt = (new Connection)->connect()->prepare($sql);

		if ($stmt->execute()) {

			return $stmt->fetch();

			$stmt->close();

			$stmt = null;
		} else {

			return "error";
		}

	}
}
