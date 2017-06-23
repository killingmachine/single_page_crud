<?php
class User{
	public $email = '';
	public $userName = '';
	public $password = '';
	public $dteCreated = '';
	function __construct($email, $userName, $pass,$dteCreated){
		$this->email = $email;
		$this->userName = $userName;
		$this->password = $pass;
		$this->dteCreated = $dteCreated;
	}
	


}
class CrudTbl{
	public static function display($con,$tbl,$lmt){
		if(is_null($lmt)){
			$sql = $con->query("SELECT * FROM $tbl ORDER BY created_at DESC");
		}
		else{
			$sql = $con->query("SELECT * FROM $tbl ORDER BY created_at DESC LIMIT $lmt");
		}	
		return $sql;
	}
	public static function findObj($con,$tbl,$un_col,$val){
		$sql = $con->prepare("SELECT * FROM $tbl WHERE $un_col = :uniq_val");
		$sql->execute(['uniq_val' => $val]);
		return $sql;
	}
	public static function add_user(User $user,$tbl,$con){
			$Asql = $con->prepare("INSERT INTO $tbl(user_name, password, email, created_at) VALUES(:uname,:pass,:em, :dte)");
			$Asql->execute(['uname' => $user->userName,
							'pass' => $user->password,
							'em' => $user->email, 
							"dte" => $user->dteCreated]);

			return $Asql;

	}
	public static function update_user(User $user,$tbl,$con,$val){
			$sql = $con->prepare("UPDATE $tbl SET user_name=:uname,
								password=:pass,
								email = :em
								WHERE user_id = $val");
			$sql->execute(['uname' => $user->userName,
							'pass' => $user->password,
							'em' => $user->email 
						]);
			return $sql;

	}
	public static function delete_user($id,$tbl,$con){
		$sql = $con->prepare("DELETE FROM $tbl WHERE user_id = :id");
		$sql->execute(['id' => $id]);
		return $sql->rowCount(); 

	}
}
?>