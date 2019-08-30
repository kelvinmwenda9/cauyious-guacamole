<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>USER LOGIN</title>
</head>
<body>
	<h1 class="jumbotron alert alert-info">Xkys Login Form</h1>
	<p>(Xkys) Please Fill Your User Credentials.</p>
	<!-- user_id(Auto),email(Unique), username, password, confirm, role, saved_date(timestamp) (You don't save password and confirm in the table)-->
	<!-- create table tbl_users -->
	<!-- create a form and save the record -->
	<form method="POST">
		<input type="username" name="username" placeholder="enter your username"><br><br>
		<input type="password" name="password" placeholder="enter your password"><br><br>
		<input type="submit" name="submit">

	</form><br>

	<p>Not Registered? 	<a href="addMember.php">Register Here</a></p>
	<!-- create login.php and a form with email and password -->

</body>
</html>

<?php 
	
	
	if (empty($_POST)) {
		# code...
	}

	else {

		$username = $_POST['username'];
		$password = $_POST['password'];

		$connection = mysqli_connect("localhost","root","","Xkys_db");

		$sql = "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'";

		//above query confirms if user inputs are the ones in db

		$response = mysqli_query($connection, $sql);

		// response has 0 row or i row

		$num_rows = mysqli_num_rows($response);

		if ($num_rows < 1) {
			echo "<br> Wrong credentials, Please create account";
			exit();
		}

		elseif ($num_rows > 1) { //theres a double registration

			echo "Error, Contact admin";
			exit();

		}

		elseif ($num_rows==1) 
		{//Right credentials redirect...to insertCar.php
			//create a session
			//what is the role of logged in person
			$row = mysqli_fetch_array($response);
			$username = $row[3];
			$role = $row[4];

			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['role'] = $role;

			//we store user logged in user details in sessions(temporary)
			

			header("location:memberReport.php");

/*			echo "$role  $username $user_id";
*/		}

		else{
			echo "<br> Wrong Credentials. Please Create an account";
			exit();
		}







	}


 ?>