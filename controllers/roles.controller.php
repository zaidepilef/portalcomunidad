<?php
//require_once "../models/roles.model.php";

class ControllerRoles
{

	/*
	=============================================
	 - TODOS LOS ROLES
	=============================================
	*/
	static public function ctrShowRoles(){
		$answer = RolesModel::mdlRoles();
		return $answer;
	}
	
	/**
	 * delete user roles la ra caduno
	 */
	static public function ctrDeleteUserRoles($user_id,$role_id){
		$answer = RolesModel::mdlDeleteRoleUser($user_id,$role_id);
		return $answer;
	}

}
