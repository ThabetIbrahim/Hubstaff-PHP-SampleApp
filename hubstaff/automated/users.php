<?php 
ini_set("display_errors",1);
	class test_users
	{
		public $hubstaff_api;
		public $app_token = "";
		function __construct()
		{
			include("../hubstaff.php");
			$this->hubstaff_api = new hubstaff\Client($this->app_token);
		}		
		public function users()
		{
			return json_decode(json_encode($this->hubstaff_api->users()), True);
		}
		public function find_user()
		{
			$users = $this->users();
			$id = $users["users"][0]["id"];
			return $this->hubstaff_api->find_user($id);
			
		}
		public function find_user_projects()
		{
			$users = $this->users();
			$id = $users["users"][0]["id"];
			return $this->hubstaff_api->find_user_projects($id);
		}
		public function find_user_orgs()
		{
			$users = $this->users();
			$id = $users["users"][0]["id"];
			return $this->hubstaff_api->find_user_orgs($id);
		}
	}
?>