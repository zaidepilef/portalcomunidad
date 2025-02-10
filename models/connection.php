<?php

class Connection
{

	public function connect()
	{
		$env = parse_ini_file(__DIR__ . '/../.env');
		$db_host = $env['DB_HOST'];
		$db_port = $env['DB_PORT'];
		$db_name = $env['DB_NAME'];
		$db_user = $env['DB_USER'];
		$db_password = $env['DB_PASSWORD'];

		$link = new PDO("mysql:host=" . $db_host . ";port=" . $db_port . ";dbname=" . $db_name, $db_user, $db_password);

		$link->exec("set names utf8");

		return $link;
	}
	
}
