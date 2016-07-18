<div class = "second-header" >
	<h1>Screenshots</h1>
	<?php
		$start_date = '';
		$end_date = '';
		
		
		$params = array();
		$params['start_time'] = "start_time";
		$params['stop_time']  = "stop_time";
		$params["offset"]  = "offset";
		$params["options"][]  = "organizations";
		$params["options"][]  = "projects";
		$params["options"][]  = "users";
		
		
		
		$value_type = array();
		$value_type['organizations'] = 'input';
		$value_type['projects'] = 'input';
		$value_type['users'] = 'input';
		$value_type['start_time'] = 'datetime';
		$value_type['stop_time'] = 'datetime';
		$value_type['offset'] = 'input';

		$screenshots = '';
		if($_SERVER['REQUEST_METHOD'] == "POST")
		{
			$start_time = $_POST['start_time'];
			$stop_time = $_POST['stop_time'];

			$options = $_POST['options'];
			if(!$offset)
			{
				$offset = 0;
			}
			$screenshots = $hubstaff->screenshots($start_time, $stop_time, $offset, $options);
			if(isset($screenshots->error))
			{
				echo '<div class = "info" >'.$screenshots->error.'</div>';
			}
		}

		if($screenshots){
			foreach($screenshots->screenshots as $screenshot)
			{
				echo "<img src = '".$screenshot->url."' />";
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
