

<!DOCTYPE html>
<html>
<head>
	<title>Image Upload</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div id="content" class="text-center">
		<h1>SharePic</h1>
		<form method="POST" enctype="multipart/form-data">
			<input type="hidden" name="size" value="1000000">
			<div>
				<input type="file" name="image">
			</div>
			<div>
				<textarea id="text" cols="40" rows="4" name="image_text" placeholder="Say something about this image..."></textarea>
			</div><br>
			<input type="tel" name="phone" placeholder="Enter your phone number"><br><br>
			<input type="number" name="cost" placeholder="Enter item Cost (Kes)"><br><br>
			<div>
				<button type="submit" name="upload" class="btn btn-info">POST</button><br><br>
			</div>
		</form>
	</div>
</body>
</html>

<?php
	// Create database connection
	$db = mysqli_connect("localhost", "root", "", "Xkys_db");
	// If upload button is clicked ...
	if (isset($_POST['upload'])) {
	// Get image name
	$image = $_FILES['image']['name'];
	// Get text
	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);
	$phone = $_POST['phone'];
	$cost = $_POST['cost'];

	//goto https://justpaste.it/1snnv
	//paste here
	//validation
	//get image width and height

	$fileinfo = @getimagesize($_FILES["image"]["tmp_name"]);
	$width = $fileinfo[0];
	$height = $fileinfo[1];

	//specify allowed extensions
	$allowed_image_extension = array("png","jpg","jpeg");

	//what is the extension of image being uploaded?
	$file_extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
	// Validate file input to check if is not empty
	if (! file_exists($_FILES["image"]["tmp_name"])) {
	echo "Choose image file to upload";
	} // Validate file input to check if is with valid extension
	else if (! in_array($file_extension, $allowed_image_extension)) {
	echo "Upload valiid images. Only PNG and JPEG are allowed.";
	} // Validate image file size
	else if (($_FILES["image"]["size"] > 2000000)) {
	echo "Image size exceeds 2MB";
	} // Validate image file dimension
	else if ($width > "500" || $height > "500") {
	echo "Image dimension should be within 500X500";;
	}
	//this function check a real image regardless of the extension
	else if(!exif_imagetype($_FILES['image']['tmp_name'])) {
	echo "This is not an image, Please upload an image";
	}

	else { 
	// image file directory
	$target = "images/".basename($image);

	$sql = "INSERT INTO images (image, image_text, phone, cost) VALUES ('$image', '$image_text', '$phone', '$cost')";
	// execute query
	mysqli_query($db, $sql);

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
	//echo "Image uploaded successfully";
	}else{
	echo"Failed to upload image";
	}

	}


	}//close else

	//part 2
	$result = mysqli_query($db, "SELECT * FROM images");
	echo "<div class='row'>";
	while ($row = mysqli_fetch_array($result)) {
	echo "<div class='col-md-4 card'>";
	echo "<img src='images/".$row['image']."' >";
	echo "<p>".$row['image_text']."</p>";
	echo "<p>".$row['phone']."</p>";
	echo "<p>".$row['cost']."</p>";
	echo "<a href='' class='btn btn-dark'>Buy Now</a> ";
	echo "</div>";

	//TODO: check image contents to approve its a real image
	//to support the extensions checked.
	//Image scanners.
	//add two more columns phone and cost
	}
	echo "</div>";
?>

