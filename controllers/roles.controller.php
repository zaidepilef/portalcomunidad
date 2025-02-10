<?php

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

}
