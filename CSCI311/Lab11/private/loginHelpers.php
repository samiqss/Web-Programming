<!-- Created by Sami Al-Qusus April 1, 2018 -->
<!-- modified April 1, 2018 -->
<!-- loginHelpers.php required for Lab11 -->
<?php
require('dbinfo.inc');

        function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	function password_encrypt($password){
		$hash_format = "$2y$10$";
		$salt_length = 22;
		$salt = generate_salt($salt_length);
		$format_and_salt = $hash_format.$salt;
		$hash = crypt($password, $format_and_salt);
		return $hash;
	}	
	
	function generate_salt($length){
		//generate pseudo random string (good enough)
		//returns 32 characters
		$unique_random_string = md5(uniqid(mt_rand(), true));
		
		//convert it to base 64 (valid chars are [a-zA-Z0-0./] )
		$base64_string = base64_encode($unique_random_string);
		
		//remove the '+' characters, just replace with '.'
		$modified_base64_string = str_replace('+', '.', $base64_string);
		
		//truncate off just what we need
		$salt = substr($modified_base64_string, 0, $length);
		
		return $salt;
	}
	function password_check($password, $existing_hash){
		$hash = crypt($password, $existing_hash);
		if($hash === $existing_hash){
			return true;
		}else{
			return false;
		}
	}
	
	function attempt_login($userID, $pw){
		global $host, $user, $password, $theme;
		$myHandle;
		try {
			$myHandle = new PDO("mysql:host=$host;dbname=$user", $user, $password);
		}catch(PDOException $e){
			 print "Error!" . $e->getMessage() . "<br/>";
		}
		if($myHandle){
			$sql = "SELECT username, password, scheme FROM members WHERE username=:u_name";
			$myStmt = $myHandle->prepare($sql);
			$myStmt->bindParam(':u_name',$userID);
			$myStmt->execute();
			$rslt = $myStmt->fetchAll();
			if(count($rslt)>0){
				foreach($rslt as $row){
					$hashed_pw = $row['password'];
					$theme=$row['scheme'];
				}
				if(password_check($pw,$hashed_pw)){
					return true;
				}else{
					return false;
					 }
			}else{
				return false;
			}
		}
		return false;
	}

	function createAccount($username,$pw,$email,$theme){
		global $host, $user, $password;
		$myHandle;
		try {
			$myHandle = new PDO("mysql:host=$host;dbname=$user", $user, $password);
		}catch(PDOException $e){
			print "Error!" . $e->getMessage() . "<br/>";
		}
		if($myHandle){
			$myStmt =$myHandle->prepare("SELECT count(*) as total FROM members WHERE username=:u_name");
			$myStmt->bindParam(':u_name', $username);
			$myStmt->execute();
			$count = $myStmt->fetchColumn();
			if($count==0){
				$sql = "INSERT into members (username, password, email, scheme) VALUES (:u_name, :p_word, :mail, :theme)";
				$insertStmt = $myHandle->prepare($sql);
				//hash the password
				$hashed_pw = password_encrypt($pw);
				$insertStmt->bindParam(':u_name', $username);
				$insertStmt->bindParam(':p_word', $hashed_pw);
				$insertStmt->bindParam(':mail', $email);
				$insertStmt->bindParam(':theme', $theme);
			       $insertStmt->execute();
				return true;
			}else{
				return false;
			}
		}
		 $myHandle = null;
		return false;
	}

?>
