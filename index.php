<html>
	<?php 
	
	include("includes/header.php");
	
	if(!$_SESSION['base_url'])
	{
		$base = explode("/",$_SERVER['SCRIPT_NAME']);
		unset($base[sizeof($base) - 1]);
		$_SESSION['base_url'] = "http://".$_SERVER['HTTP_HOST'].implode("/",$base);
	}

	session_start();

	if(!isset($_SESSION["logged"]))
		$_SESSION["logged"] = 0;
	echo "<body><div class = 'content' >";
	if(!$_SESSION["logged"] && !isset($_GET['page']))
	{
		include("pages/home.php");
	}else
	{
		if(isset($_GET['page']))
			if($_GET['page'])
				if(is_file($_GET['page'].".php"))
					include($_GET['page'].".php");
				else
					include("pages/home.php");
			else
				include("pages/home.php");
		else
			include("pages/home.php");
	}
	echo "</div></body>";
	?>

</html>