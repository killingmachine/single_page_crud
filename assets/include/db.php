<?php
	$host = '127.0.0.1';
	$user = 'root';
	$myDB = 'crud';
	$charset = 'utf8';
	$pass = '';
	$opt = [
	    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	    PDO::ATTR_EMULATE_PREPARES   => false,
	];

	try{
		$conn = new PDO("mysql:host=$host;dbname=$myDB;charset=$charset", $user, $pass,$opt);
	}
	catch(PDOException $e){
	 	echo "Connection failed: " . $e->getMessage();
	}
 ?>	
