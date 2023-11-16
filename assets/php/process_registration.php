<?php
include("connection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST["name"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$matricNum = $_POST["matricNum"];
	$mobile = $_POST["mobile"];
	
	// prepare SQL query
	$sql = "SELECT * FROM user WHERE email = '$email'";

	// execute query
	$result = mysqli_query($connection, $sql);

	// check if email exists
	if (mysqli_num_rows($result) > 0) {

		header("Location: ../../register.html");
	} else {
		mysqli_query($connection, "INSERT INTO user(name,password,email,mobile, matricNum) VALUES('$name','$password','$email','$mobile','$matricNum')");
		
		
		$sql = "SELECT * FROM user ORDER BY user_ID DESC LIMIT 1";

		// execute the query
		$result = mysqli_query($connection, $sql);
		session_start();
		// check if the query returned any rows
		if (mysqli_num_rows($result) > 0) {
		  // email and password are correct
			$res = $result->fetch_assoc();
			$_SESSION['user_ID'] = $res['user_ID'];
			$_SESSION['name'] = $res['name'];
			$_SESSION["email"] = $res['email'];
			$_SESSION["password"] = $res['password'];
			$_SESSION["mobile"] = $res['mobile'];
			$_SESSION["matricNum"] = $res['matricNum'];
			$_SESSION["about"] = $res['about'];
			$_SESSION["hobbies"] = $res['hobbies'];
			$_SESSION["position"] = $res['position'];
			
			
			header("Location: ../../myProfile.php");
		} 

	}
}
?>
