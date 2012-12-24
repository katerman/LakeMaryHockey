<?php

class AuthModel{

	public $db;
	
	public function __construct($dsn, $user, $pass){
		try{
		$this->db = new PDO($dsn, $user, $pass);
		
		}catch (PDOException $e){
			
			var_dump($e);
		}
		//$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}
	
	//get users
	public function getUserByNamePass($name, $pass){
		$stmt = $this->db->prepare("
			SELECT user_id AS id, user_name AS name, user_fullname AS fullname
			FROM users
			WHERE (user_name = :name)
				AND (user_password = MD5(CONCAT(user_salt,:pass)))
		");
		if ($stmt->execute(array(':name' => $name, ':pass' => $pass))){
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if(count($rows) === 1) {
				return $rows[0];
			}
		}
		return FALSE;
	}//end of get users
	
	
	
	
	
	
}


?>