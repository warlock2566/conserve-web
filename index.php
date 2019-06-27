<?php
require_once('head.php');
require_once('nav.php');
?>
<body>
	<div class='msg'>
		<h1>Our Vanishing Wildlife</h1>
		<h3>Question: <br> What can we do to save our wildlife?</h3>
	</div>
	<div class='learn'>
		<h3><u>Answer: <br> LEARN EVERYTHING WE CAN!!!</u></h3>	
		<button id='myButton' style='font-size: 16px;'>Click here to learn more!</button>
	</div>
	<div class='image1'>
		<img src="images/black_rhino.jpg" alt="Black Rhino" height="200" width="200">
	</div>
	<div class='image2'>
		<img src="images/porpoise.jpg" alt="Finless Porpoise" height="200" width="200">
	</div>
	<div class='image3'>
		<img src="images/buffalo.jpg" alt="Buffalo laying in a field" height="200" width="200">
	</div>
	<div class='image4'>
		<img src="images/lion.jpg" alt="Wildlife Conservation" height="200" width="200">
	</div>	
	<div class='image5'>
		<img src="images/saola.jpg" alt="Deer" height="200" width="200">
	</div>	
	<div class='image6'>
		<img src="images/gorilla.jpg" alt="Gorilla" height="200" width="200">
	</div>
</body>
<script type="text/javascript">
    document.getElementById("myButton").onclick = function () {
        location.href = "info.php";
    };
</script>

<?php 
require_once('foot.php');
?>