<?php
require '../required/connect.php';
require 'head.php';
require 'nav.php';

// echo getcwd() . "\n"; // Displays the working directory.

$sql = "CREATE TABLE IF NOT EXISTS images (
			  imgID int(11) PRIMARY KEY AUTO_INCREMENT,
			  name varchar(100) NULL,
			  title varchar(150)  NULL)";		
			  
$result = mysqli_query($con, $sql) or die("Unable to create table: $sql");

// Feedback variables- set to false to disable debugging messages.
$debug = false;
$flag = true;
$msg = "";
$out = "";
$error[] = "";

$dirpath = realpath(dirname(getcwd()));

if(isset($_FILES['img']))
{
	$tmpName = $_FILES['img']['tmp_name'];	
		
	$out .= "Temp file name: $tmpName<br>";	
	
	// Check for FILE ERROR CODE > 0
	if($_FILES['img']['error'] == UPLOAD_ERR_OK)
	{
		$out .= "No error code<br>";
	}
	else
	{
		$out .= "Bad Upload - <br>";
		// Contains the PHP error code - see documentation
		$out .= "Error Code: " . $_FILES['img']['error'] . "<br>";
		$flag = false;
	}
	
	// File size check in BYTES  (1,024,000 = 1MB)
	if($_FILES['img']['size'] > 2500000)
	{
		$out .= "Sorry, file is too big. Max is 2.4MB<br>";
		$flag = false;
	}
	else
	{
		$out .= "This is an acceptable sized file.<br>";
	}
	
	// Allow certain file formats
	$imgFile = $_FILES['img']['type'];
	$out .= "File Type: " . $imgFile . "<br>";
	if($imgFile != "image/jpg" && $imgFile != "image/jpeg" && $imgFile != "image/gif" && $imgFile != "image/png")
	{
		$out .= "Please upload JPEG, JPG, PNG, & GIF files only.<br>";
		$flag = false;
	}
	else
	{
		$out .= "Everything looks good. Thank you.<br>";
	}
	
	// You can check for certain types - see documentation
	// Files smaller than 100 bytes generate a certain error
	if(filesize($tmpName) > 100)
	{
		if(exif_imagetype($tmpName))
		{
			$out .= "Header: This is an image<br>";
		}	
	}
	else
	{
		$out .= "Header: This is not an image, please make sure file is over 100 bytes.<br>";
		$flag = false;
	}
	
	if($flag)
	{		
		$title = mysqli_real_escape_string($con, $_POST['title']);
		// Replaces -s with 's
		$cleanName = str_replace('-s', '\'s', $_FILES['img']['name']);	
		// Replace spaces with underscores 
		$cleanName = str_replace(' ', '_', $cleanName);	
		// Replaces dashes with underscores
		$cleanName = str_replace('', '_', $cleanName);

		// Change name of image file
		$date = date_create();
		$timest = date_timestamp_get($date);
		$newName = $timest.$cleanName;
		$out .= "New name of file is: " . $newName . "<br>";
	
		if(empty($newName))
		{	
			echo "Please select a file to upload.<br>";
		}
		elseif(empty($_POST['title']))
		{
			echo "Please enter a title.<br>";
		}
		else
		{
			// Move the file to the proper location (uploads/)
			if(!move_uploaded_file($tmpName, 'uploads/'.$newName))
			{
				$out .= "Move to uploads folder: unsuccessful!!!";
			}
			else
			{
				$out .= "Move to uploads folder: Successful!!!";
			}	
		}
		
		if(empty($newName) || empty($title))
		{
			echo "Please fill out form completely";
		}
		else
		{
			$sql = "INSERT INTO images (name, title) VALUES ('$newName', '$title')";	
			$result = mysqli_query($con, $sql) or die("Unable to insert into table: $sql");
			
			$msg .= "<div class = 'msg'>File has uploaded successfully.</div><br>";
		}		
	}
	else
	{
		$msg .= "<div class = 'msg'>File was not uploaded. Please check file size, type, and category are filled in or selected, then try again.</div><br>";
	}	
}
?>
<div class = 'upload'>
<h1>Image Upload</h1><br>
	<form method = 'POST' action = '<?php echo $_SERVER['PHP_SELF'] ?>' enctype = 'multipart/form-data'>
		<label>Title of Image:</label><br><input type = 'text' name = 'title'><br><br>		
		<input type = 'file' class = 'img' name = 'img'><br><br>
		<input type = 'hidden' name = 'MAX_FILE_SIZE' value = '2500000'>		
		<input type = 'submit' value = 'Upload'>
	</form><br>
</div>
	
	<?php
	if($debug)
	{
		echo $out;
	}
	else
	{
		echo $msg;
	}
	?>

<?php
require 'foot.php';
?>