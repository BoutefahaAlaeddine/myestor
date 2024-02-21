<?php 
namespace PHPMVC\LIB\Database;

class DB{
	static public function connect(){
		$db = new \PDO('mysql:hostname=' . DATABASE_HOST_NAME . ';dbname=' . DATABASE_DB_NAME,
    DATABASE_USER_NAME, DATABASE_PASSWORD);
		$db->exec("set names utf8");
		$db->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_WARNING);
		return $db;
	}
}

?>