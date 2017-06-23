<?php
	require "assets/include/db.php";
	require "assets/include/user_class.php";
	function checkUserName($cnt){
		if($cnt == 0)
			return "";
		else
			return "duplicate username";
		
	}
	////

	if(isset($_POST['setId']) && isset($_POST['e_uname']) && isset($_POST['e_pass']) && isset($_POST['e_email'])){
		$userId =  $_POST['setId'];
		$e_uname = $_POST['e_uname'];
		$e_pass = $_POST['e_pass'];
		$e_email = $_POST['e_email'];
			$usrObj = new User($e_email,$e_uname,$e_pass,'');
			if(CrudTbl::findObj($conn,'user',"user_name",$e_uname)->rowCount() > 0){
				echo 'no duplicate username';
			}
			else{
				$update = CrudTbl::update_user($usrObj,'user',$conn,$userId);
				if($update->rosCount()>0){

					echo "Updated";	
				}
				else{
					echo "no changes";
				}
			}
		
	}
	if(isset($_POST['getOb'])){
		
		$val = $_POST['getOb'];
		$getUsr = CrudTbl::findObj($conn,'user',"user_id",$val);
		
		while($result = $getUsr->fetch(PDO::FETCH_OBJ)){
			
			echo "<label for='e_userName'>username:</label>";
			echo "<input value='$result->user_name' id='e_userName' class=form-control type='text' id='userName'>";
			echo "<span id='e_u_valid'></span>";
			echo "<label for='e_pass'>password:</label><input id='togBox' type='checkbox'>";
			echo "<input value='$result->password' class='form-control' type='password' id='e_pass'>";
			echo "<label for='e_email'>email</label>";
			echo "<input value='$result->email' class='form-control' type='text' id='e_email'> ";       		
			echo "<button value='$result->user_id' id='upNow'>update</button><button data-dismiss='modal'>cancel</button><span id='upMsg'></span>";

			
		}
		  			        		

	}

	
	if(isset($_POST['del'])){
		CrudTbl::delete_user($_POST['del'],'user',$conn);
		
		 echo "succesfully deleted";
		

	}
	if(isset($_POST["chkUname"])){
		$uname = $_POST["chkUname"];
		$users = CrudTbl::findObj($conn,'user',"user_name",$uname)->rowCount();
		echo checkUserName($users);
	}
	if(isset($_POST['uname']) && isset($_POST['pass']) && isset($_POST['email'])){
		$user = $_POST['uname'];
		$pass = $_POST['pass'];
		$email = $_POST['email'];
		$dte = $_POST['daT'];
		if($user == '' || $pass == '' || $email == ''){
			echo 'pls fill up the textboxes';
		}
		else{
			
			if(CrudTbl::findObj($conn,'user',"user_name",$user)->rowCount() > 0){
				echo "NO DUPLICATE USERNAME";
			}
			else{
				$usrObj = new User($email,$user,$pass,$dte);
				CrudTbl::add_user($usrObj,'user',$conn);
				unset($_POST['uname']);
				echo "succesfully added";
			}
		}
		
	}
	if(isset($_POST['upTable'])){

			$users = CrudTbl::display($conn,'user',$_POST['upTable']); ///this will return query object

			while($result = $users->fetch(PDO::FETCH_OBJ)){
				echo "<tr>";
				echo "<td>".$result->user_name."</td>";
				echo "<td>".md5($result->password)."</td>";
				echo "<td>".$result->email."</td>";
				echo "<td><button class='updateBtn' data-toggle='modal' data-target='#k' value='$result->user_id'>Update</button><td>";
				echo "<td><button data-toggle='modal' data-target='#delModal' value='$result->user_id' class='delBtn' >Delete</button><td>";
				echo "<tr/>";

				
			}			
	}


?>