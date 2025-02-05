<?php

class Connection{

	public function connect(){

		$link = new PDO("mysql:host=localhost;port=3306;dbname=pos-english", "root", "");

		$link -> exec("set names utf8");

		return $link;
	}

}
