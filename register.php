<?php
	// Include config file
	require_once "config.php";
	//Define Variables and initialize with empty values
	$username = $password = $confirm_password = "";
	$username_err = $password_err = $confirm_password_err = "";
	//Processing form data when form is submitted
	if($_SERVER['REQUEST_METHOD'] == "POST"){
	// Validate Username
	if(empty(trim($_POST['username']))){
		$username_err = "Please Enter a username.";				
	} else {
		//Prepare A select statement
		$sql = "SELECT id FROM users WHERE username = ?";
		if($stmt = $mysqli->prepare($sql)){
			// Bind the variable to the prepared statment as parameter.
			$stmt->bind_param("s", $param_username);
			
			//set Parameters
			$param_username = tirm($_POST('username'));
			
			//Attempt to execute the prepared statement.
			if($stmt->execute()){
				//store Result
				$stmt->store_result();
				if($stmt->num_rows == 1){
					$username_err = "This username is already Taken.";
				}else {
					$username = tirm($_POST['usrname']);
				}
			}else {
				echo "Oops! Something went wrong. please try agian later.";
			}
		}
		// close statement
		$stmt->close();
	}
	
	}	

	
	//Validate Password
	if(empty(trim($_POST['password']))){
		$password_err = "Please Enter a password";
	}elseif(strlen(trim($_POST['password])) < 6){
		$password_err = "Password must have at least 6 characters.";
	}else {
		$password = trim($_POST['password']);
	}
