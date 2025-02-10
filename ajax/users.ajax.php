<?php

require_once "../controllers/users.controller.php";
require_once "../controllers/roles.controller.php";
require_once "../models/users.model.php";
require_once "../models/roles.model.php";

class AjaxUsers{

	/*=============================================
	EDIT USER
	=============================================*/

	public $idUser;
	public $idRole;
	public $activateUser;
	public $activateId;	
	public $validateUser;

	public function ajaxEditUser(){
		$item = "id";
		$value = $this->idUser;
		$answer = ControllerUsers::ctrShowUsers($item, $value);
		echo json_encode($answer);
	}


	/*=============================================
	ACTIVATE USER
	=============================================*/
	public function ajaxActivateUser(){
		$table = "users";
		$item1 = "status";
		$value1 = $this->activateUser;
		$item2 = "id";
		$value2 = $this->activateId;
		$answer = UsersModel::mdlUpdateUser($table, $item1, $value1, $item2, $value2);
	}


	/*=============================================
	VALIDATE IF USER ALREADY EXISTS
	=============================================*/
	public function ajaxValidateUser(){
		$item = "user";
		$value = $this->validateUser;
		$answer = ControllerUsers::ctrShowUsers($item, $value);
		echo json_encode($answer);
	}

	/*
	=============================================
	 - ELIMINA ROLE USER
	=============================================
	*/
    public function ajaxDeleteRoleUser() {
        $answer = ControllerRoles::ctrDeleteUserRoles($this->idUser, $this->idRole);
        echo json_encode(["status" => "success", "response" => $answer]);
        exit;
    }


}


/*=============================================
EDIT USER
=============================================*/

if (isset($_POST["idUser"])) {

	$edit = new AjaxUsers();
	$edit -> idUser = $_POST["idUser"];
	$edit -> ajaxEditUser();
}

/*=============================================
ACTIVATE USER
=============================================*/

if (isset($_POST["activateUser"])) {

	$activateUser = new AjaxUsers();
	$activateUser -> activateUser = $_POST["activateUser"];
	$activateUser -> activateId = $_POST["activateId"];
	$activateUser -> ajaxActivateUser();
}


/*
=============================================
VALIDATE IF USER ALREADY EXISTS
=============================================
*/
if (isset($_POST["validateUser"])) {

	$valUser = new AjaxUsers();
	$valUser -> validateUser = $_POST["validateUser"];
	$valUser -> ajaxValidateUser();
}

/*
=============================================
ELIMINAR ROLE USER
=============================================
*/
if ( isset($_POST["user_id"]) && isset($_POST["role_id"])) {

	$delRoleUser = new AjaxUsers();
	$delRoleUser -> idUser = $_POST["user_id"];
	$delRoleUser -> idRole = $_POST["role_id"];
	$delRoleUser -> ajaxDeleteRoleUser();
}
