<?php
require_once("../required/connect.php");
require_once('head.php');
require_once('nav.php');

$sql = "SELECT * FROM endangered";
$result = mysqli_query($con, $sql) or die("Failed Query: $sql"); 
?>

<body>
	<h1 class='facts'>Here are some fact that you should find interesting.</h1>
	<table border='1' class='endangered' >
		<tr>
			<th>Name</th>
			<th>Scientific Name</th>
			<th>Conservation Status</th>
		</tr>
<?php		
	while($row = $result->fetch_array())
	{
	
		echo "<tr>";
		echo "<td><a href='" . $row['link'] . "'>" . $row['cName'] . "</a></td>";
		echo "<td><b><i>" . $row['sName'] . "</i></b></td>";
		echo "<td>" . $row['conStatus'] . "</td>";
		echo "</tr>";	
	}
?>
	</table>
</body>
<script>
$(document).ready(function() 
{
  var totalRows = $('.endangered').find('tbody tr:has(td)').length;
  var recordPerPage = 26;
  var totalPages = Math.ceil(totalRows / recordPerPage);
  var $pages = $('<div id="pages"></div>');
  for (i = 0; i < totalPages; i++) {
    $('<span class="pageNumber">&nbsp;' + (i + 1) + '</span>').appendTo($pages);
  }
  $pages.appendTo('.endangered');

  $('.pageNumber').hover(
    function() {
      $(this).addClass('focus');
    },
    function() {
      $(this).removeClass('focus');
    }
  );

  $('table').find('tbody tr:has(td)').hide();
  var tr = $('table tbody tr:has(td)');
  for (var i = 0; i <= recordPerPage - 1; i++) {
    $(tr[i]).show();
  }
  $('span').click(function(event) {
    $('.endangered').find('tbody tr:has(td)').hide();
    var nBegin = ($(this).text() - 1) * recordPerPage;
    var nEnd = $(this).text() * recordPerPage - 1;
    for (var i = nBegin; i <= nEnd; i++) {
      $(tr[i]).show();
    }
  });
});
</script>
<?php 
require_once('foot.php');
?>