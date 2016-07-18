<div class = "second-header" >
	<h1>Reports</h1>
	<?php
		$start_date = '';
		$end_date = '';
		
		
		$params = array();
		$params['start_date'] = "start_date";
		$params['end_date']   = "end_date";
		$params["options"][]  = "organizations";
		$params["options"][]  = "projects";
		$params["options"][]  = "users";
		$params["options"][]  = "show_tasks";
		$params["options"][]  = "show_notes";
		$params["options"][]  = "show_activity";
		$params["options"][]  = "include_archived";
		
		
		
		$value_type = array();
		$value_type['organizations'] = 'input';
		$value_type['projects'] = 'input';
		$value_type['users'] = 'input';
		$value_type['start_date'] = 'datetime';
		$value_type['end_date'] = 'datetime';
		$value_type['show_tasks'] = 'select';
		$value_type['show_notes'] = 'select';
		$value_type['show_activity'] = 'select';
		$value_type['include_archived'] = 'select';
		$report = '';
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$options = $_POST['options'];
			$report = $hubstaff->custom_date_team($start_date, $end_date, $options);
			if(isset($report->error))
			{
				echo '<div class = "info" >'.$report->error.'</div>';
			}
		}
	?>
	<?php if($report){
			foreach($report->organizations as $org)
			{
				echo "<h2>Organization Name: ".$org->name."</h2>";
				foreach($org->dates as $dates)
				{
					foreach($dates->users as $users)
					{
						echo "<h3>User Name: ".$users->name."</h3>";
						echo "<h4>Time Spent: ".$users->duration."</h4>";
						echo "<br>";
						foreach($users->projects as $projects)
						{
							echo "<h4>Project Name: ".$projects->name."</h4>";
							echo "<h5>Time Spent: ".$projects->duration."</h5>";
							echo "<br>";
						}
					}
				}
			}
			
			
	}	
	?>
	<form method = "post" action = "http://<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; ?>" >
		<div class="container">
		    <div class="row">
		        <div class='col-md-12'>
		        	<?php 
		        		$i = 0;
		        		foreach($params as $index => $param)
						{

							if($index == "options")
							{
								foreach($params[$index] as $option_param)
								{
									if($value_type[$option_param] == "input")
									{
										echo '<div class = "input-container" ><span class = "title">'.$option_param.'</span><input type = "text" name = "options['.$option_param.']" ></div>';
									}else if($value_type[$option_param] == "datetime")
									{
										echo '<div class = "input-container" ><span class = "title">'.$option_param.'</span><input type = "text" name = "options['.$option_param.']" class="form-control time" ></div>';
									}else
									{
										echo '<div class = "input-container" ><span class = "title">'.$option_param.'</span><select name = "options['.$option_param.']" ><option>0</option><option>1</option></select></div>';
									}
								}
								
							}
							else {
								
								if($value_type[$param] == "input")
								{
									echo '<div class = "input-container" ><span class = "title">'.$param.'</span><input type = "text" name = "'.$param.'" ></div>';
								}else if($value_type[$param] == "datetime")
								{
									echo '<div class = "input-container" ><span class = "title">'.$param.'</span><input type = "text" name = "'.$param.'" class="form-control time" ></div>';
								}else
								{
									echo '<div class = "input-container" ><span class = "title">'.$param.'</span><select name = "'.$param.'" ><option>0</option><option>1</option></select></div>';
								}
							}

						}
						
		        	
		        	?>
		        </div>
		        <script type="text/javascript">
		            $(function () {
		                $('.time').datetimepicker({
		                	format: "YYYY-MM-DD"
		                });
		            });
		        </script>
		    </div>
		</div>
		<br />
		<input type = "submit" class = "link" value = "Fetch">
	</form>
</div>
