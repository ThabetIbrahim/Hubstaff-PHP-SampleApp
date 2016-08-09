<?php 
	class test_notes
	{
		public $hubstaff_api;
		public $app_token = "JDzYL7shxiaCCx0_Hta3MT6WlgYWmZ1vqQa4Y91hM00";
		public $options = array();
		function __construct()
		{
			include("../hubstaff.php");
			include("users.php");
			include("projects.php");
			include("organizations.php");
			
			$users = new test_users();
			$projects = new test_projects();
			$orgs = new test_orgs();
			
			$users_data = $users->users();
			$projects_data = $projects->projects();
			$orgs_data = $orgs->organizations();

			$options["users"] = $users_data["users"][0]["id"];
			$options["projects"] = $projects_data["projects"][0]["id"];
			$options["organizations"] = $orgs_data["organizations"][0]["id"];
			
			$this->hubstaff_api = new hubstaff\Client($this->app_token);
		}		
		public function notes()
		{
            $starttime = "2016-03-14";
            $stoptime = "2016-03-20";
			return json_decode(json_encode($this->hubstaff_api->notes($starttime, $stoptime, $options, 0)), True);
		}
		public function find_note()
		{
			$notes = $this->notes();
			$id = $notes["notes"][0]["id"];
			return $this->hubstaff_api->find_note($id);
			
		}
	}

?>