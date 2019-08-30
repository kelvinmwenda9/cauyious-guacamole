<?php 
	//ask yourself is there a session if no goes back to the login page.
	session_start();
	if (!isset($_SESSION['username'])) {
		echo "Please login";
		echo "<a href='index.php'> Here </a>";
		exit();
		//header("location: index.php");
	}
	
	elseif (isset($_SESSION['username'])) {
		$username = $_SESSION['username']; //get role from session
		echo "Welcome $username";

		$role = $_SESSION['role'];//get role from the session
		if ($role=='Cashier') {
			echo "Access Denied";
			exit();
		}

	}



 ?>

<?php 

	include 'menu.php';

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Contribution</title>
</head>
<body>
	<h1>Fill in your details in the registration form below</h1>
	<form method="POST">
		<input type="text" name="id_number" placeholder="Enter your ID"><br><br>
		<input type="text" name="amount" placeholder="Enter Contribution Amount"><br><br>
		<input type="submit" name="submit">
	</form>

</body>
</html>

<?php 

	if (empty($_POST)) {
			# code...
		}

	else{

		$id_number = $_POST['id_number'];
		$amount = $_POST['amount'];

		$connect = mysqli_connect("localhost","root","","Xkys_db");
		$sql = "INSERT INTO tbl_contributions(id_number, amount) VALUES('$id_number','$amount')";

		$response = mysqli_query($connect,$sql);

		

		if ($response==true) {
			echo "Contribution has been recorded";
		}
		else{
			echo "Re-enter your data again";
		}

	}
	

 ?>