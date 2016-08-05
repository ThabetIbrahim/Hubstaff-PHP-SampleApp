<head>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel = "stylesheet" href = "css/datetimepicker.css" >
	<link rel = "stylesheet" href = "css/bootstrap.min.css" >
	<link rel = "stylesheet" href = "css/style.css?id=<?php rand(1,1000); ?>" >
	<script src = "https://code.jquery.com/jquery-3.0.0.min.js" ></script>
	<script src = "js/bootstrap.min.js" ></script>
	<script src = "js/moment.js" ></script>
	<script src = "js/datetimepicker.js" ></script>
	<script src = "js/common.js" ></script>
	<div class = "header" >
	<?php 
	
	session_start();
	if(!$_SESSION["logged"])
	{
		?>
			<a href = "?page=pages/sign_in" class = "sign-in" >Sign in</a>
		<?php
	}else
	{
			include("hubstaff/hubstaff.php");
			$hubstaff = new hubstaff\Client("JDzYL7shxiaCCx0_Hta3MT6WlgYWmZ1vqQa4Y91hM00");
		?>

			<div class = "btn-group" style = "float: left;">
				<a href = "http://www.innerchip.com/hubstaff_tot/sample_app/?page=pages/screenshots" class = "link" >Fetch Screenshots</a>
				<a href = "http://www.innerchip.com/hubstaff_tot/sample_app/?page=pages/reports" class = "link" >Fetch Reports</a>
			</div>
			<a href = "?page=pages/sign_out" class = "sign-up" >Sign out</a>

		<?php
	}

	?>
	</div>
</head>
