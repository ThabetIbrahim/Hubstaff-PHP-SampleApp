<div class = "second-header" >
	<?php 
	$email = '';
	$password = '';


	if($_SERVER['REQUEST_METHOD'] == "POST" && !$_SESSION['Auth-Token'])
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		$data = $hubstaff->auth($_POST['email'],$_POST['password']);
		if(isset($data['auth_token']))
		{
			$_SESSION['Auth-Token'] = $data['auth_token'];
			echo "<div class = 'info'>Your auth token is: ".$data['auth_token']."</div>";
		}else
		{
			echo "<div class = 'info'>error: ".$data['error']."</div>";
		}
		
	}else if(!auth_token)
	{
			echo "<div class = 'info'>Your auth token is: ".$_SESSION['Auth-Token']."</div>";
	}

	if(!$_SESSION['Auth-Token']){ ?>
	<a href = "#" class = "connect" >Connect to Hubstaff</a>
	<div class = "hubstaff-form" <?php if($_SERVER['REQUEST_METHOD'] != "POST"){ ?>style = "display: none" <?php } ?> >
		<form method = "post" action = "http://<?php echo $_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; ?>" >
			<input type = "text" name = "email" value = "<?php echo $email; ?>" placeholder="Add your Hubstaff account email address" >
			<input type = "text" name = "password" value = "<?php echo $password; ?>" placeholder="Add your Hubstaff account password" >
			<br />
			<input type = "submit" value = "Connect">
		</form>
	</div>
	<?php }else{
		?>
		<div class = "info" >Connection to hubstaff: online</div>
		<?php
	} ?>
</div>
