<?php 
	class test_activities
	{
		public $hubstaff_api;
		public $app_token = "JDzYL7shxiaCCx0_Hta3MT6WlgYWmZ1vqQa4Y91hM00";
		public $options = array();
        public $start_date = "2016-05-01";
        public $end_date = "2016-05-07";
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
            $options["show_tasks"] = "1";
            $options["show_notes"] = "1";
            $options["show_activity"] = "1";
            $options["include_archived"] = "1";
			
			$this->hubstaff_api = new hubstaff\Client($this->app_token);
		}		
		public function custom_date_team()
		{
			return ($this->hubstaff_api->custom_date_team($start_date, $end_date, $options));
		}
		public function custom_date_my()
		{
			return ($this->hubstaff_api->custom_date_my($start_date, $end_date, $options));
		}
		public function custom_member_team()
		{
			return ($this->hubstaff_api->custom_member_team($start_date, $end_date, $options));
		}
		public function custom_member_my()
		{
			return ($this->hubstaff_api->custom_member_my($start_date, $end_date, $options));
		}
		public function custom_project_team()
		{
			return ($this->hubstaff_api->custom_project_team($start_date, $end_date, $options));
		}
		public function custom_project_my()
		{
			return ($this->hubstaff_api->custom_project_my($start_date, $end_date, $options));
		}
	}

?>