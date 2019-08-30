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
		echo "Hello $username";

		$role = $_SESSION['role'];//get role from the session
		if ($role=='Intern') {
			echo "<br>Access Denied. You cannot access this page contact admin for further details.";
			echo "<br>Click the link below to go back to the menu. <br>";
			echo "<a href='menu.php'> Go Back </a>";
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
	<title>Check Contributions</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<h1 class="alert alert-warning">Xkys Finance Group</h1>
	<p>Please input your car reg number, your car details will appear</p>
	<form method="POST">
		<input type="text" name="id_number" placeholder="Enter Registration Number" required="">
		<input type="submit" name="submit">
	</form>

</body>
</html>

<?php

 	if (empty($_POST)) {
 	
		}
		 else{
		 	$id_number=$_POST['id_number'];
		 	$connection= mysqli_connect("localhost","root","","Xkys_db");
		 	$sql="SELECT id_number,SUM(amount) FROM `tbl_contributions` WHERE id_number='$id_number'";
		 	//yesterdays code
		 	//execute
		 	$dataframe= mysqli_query($connection, $sql);
		 	//count the data
		 	$num_rows = mysqli_num_rows($dataframe);
		 		if($num_rows==0){
		 			echo "No Payment Found";
		 		}
		 		else{
		 			while ($row= mysqli_fetch_array($dataframe)) 
		 			{
		 			echo "<br> ID number :$row[0] <br>";
					echo "Total Contributions :$row[1]KES <br>";
					
		 			}
		 				
				}//PASTE HERE

			}//end

?>