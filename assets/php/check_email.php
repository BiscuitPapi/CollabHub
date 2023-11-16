<?php
	

	// check if email already exists
	if (isset($_POST['email'])) {
		include("connection.php");
		$email = $_POST['email'];
		  
		$query = "SELECT * FROM user WHERE email = '$email'";
		$result = mysqli_query($connection, $query);
		  
		if (mysqli_num_rows($result) > 0) {
			// email already exists
			echo "Email already exists in the database.";
			exit;
		}
	}
	
	else {
		exit;
		
	}

?>
