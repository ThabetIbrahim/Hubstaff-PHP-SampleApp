<?php 
	class test_projects
	{
		public $hubstaff_api;
		public $app_token = "JDzYL7shxiaCCx0_Hta3MT6WlgYWmZ1vqQa4Y91hM00";
		function __construct()
		{
			include("../hubstaff.php");
			$this->hubstaff_api = new hubstaff\Client($this->app_token);
		}		
		public function projects()
		{
			return json_decode(json_encode($this->hubstaff_api->projects()), True);
		}
		public function find_project()
		{
			$projects = $this->projects();
			$id = $projects["projects"][0]["id"];
			return $this->hubstaff_api->find_project($id);
			
		}
		public function find_project_members()
		{
			$projects = $this->projects();
			$id = $projects["projects"][0]["id"];
			return $this->hubstaff_api->find_project_members($id);
		}
	}

?>