<?php
require '../required/connect.php';
require 'head.php';
require 'nav.php';

$sql = "SELECT * FROM images";
$result = mysqli_query($con, $sql) or die("Bad sql: $sql");
?>
	<table class = 'display'>
	<?php
	$i = 0;
	while($row = mysqli_fetch_assoc($result))
	{
		if($i%8 == 0)
		{
			echo "<tr>";
		}	
		if($i%4 == 0)
		{
			echo "</tr>";
		}
		echo "<td><img width = '200' height = '125' src = 'uploads/{$row['name']}' alt = '{$row['title']}' class = 'gallery'></td>
		      <td><img src = 'uploads/{$row['title']}' alt = '{$row['title']}' class = 'gallery'></td>";
		$i++;
	}
	?>
	</table>
<?php
require 'foot.php';
?>	