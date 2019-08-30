<!DOCTYPE html>
<html>
<head>
	<title>Create User</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<h1 class="jumbotron alert alert-info">Xkys Create account Form</h1>
	<form method="POST">
		<input type="email" name="email" placeholder="Enter your email"><br><br>
		<input type="text" name="username" placeholder="Enter your user name"><br><br>
		<input type="password" name="password" placeholder="Enter your password"><br><br>
		<label>Select Role: </label><br>
		<select name="role">
			<option> </option>
			<option>Cashier</option>
			<option>Member</option>
			<option>Admin</option>
		</select><br><br>

		<input type="submit" name="submit">


	</form>

	<p>You have an account? 	<a href="index.php">Login Here</a></p>

</body>
</html>

<?php 

	if (empty($_POST)) {
			# code...
		}

	else{

		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$role = $_POST['role'];
		

		$connect = mysqli_connect("localhost","root","","Xkys_db");
		$sql = "INSERT INTO tbl_users(email,password,username,role) VALUES('$email','$password','$username','$role')";

		$response = mysqli_query($connect,$sql);

		

		if ($response==true) {
			echo "Data has been recorded";
		}
		else{
			echo "Re-enter your data again";
		}

	}
	

 ?>