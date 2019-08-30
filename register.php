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
	<title>Registration</title>
</head>
<body>
	<h1>Fill in your details in the registration form below</h1>
	<form method="POST">
		<input type="text" name="fullnames" placeholder="Enter your fullnames"><br><br>
		<input type="text" name="phone" placeholder="Enter your Phone Number"><br><br>

		<label>Are you Employed? </label><br>
		<select name="employed">
			<option></option>
			<option>NO</option>
			<option>YES</option>
		</select><br><br>

		<input type="text" name="occupation" placeholder="Enter your occupation"><br><br>
		<input type="text" name="guarantor_number" placeholder="Enter your guarantor_number"><br><br>
		<input type="text" name="id_number" placeholder="Enter your ID number"><br><br>
		<input type="submit" name="submit">


	</form>

</body>
</html>

<?php 

	if (empty($_POST)) {
			# code...
		}

	else{

		$fullnames = $_POST['fullnames'];
		$phone = $_POST['phone'];
		$employed = $_POST['employed'];
		$occupation = $_POST['occupation'];
		$guarantor_number = $_POST['guarantor_number'];
		$id_number = $_POST['id_number'];


		$connect = mysqli_connect("localhost","root","","Xkys_db");
		$sql = "INSERT INTO tbl_members(fullnames,phone,employed,occupation,guarantor_number,id_number) VALUES('$fullnames','$phone','$employed','$occupation','$guarantor_number','$id_number')";

		$response = mysqli_query($connect,$sql);

		

		if ($response==true) {
			echo "Data has been recorded";
		}
		else{
			echo "Re-enter your data again";
		}

	}
	

 ?>