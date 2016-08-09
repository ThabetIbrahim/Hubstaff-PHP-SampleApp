<?php 
	class test_orgs
	{
		public $hubstaff_api;
		public $app_token = "JDzYL7shxiaCCx0_Hta3MT6WlgYWmZ1vqQa4Y91hM00";
		function __construct()
		{
			include("../hubstaff.php");
			$this->hubstaff_api = new hubstaff\Client($this->app_token);
		}		
		public function organizations()
		{
			return 	json_decode(json_encode($this->hubstaff_api->organizations()), True);
		}
		public function find_organization()
		{
			$orgs = $this->organizations();
			$id = $orgs["organizations"][0]["id"];
			return $this->hubstaff_api->find_organization($id);
			
		}
		public function find_org_projects()
		{
			$orgs = $this->organizations();
			$id = $orgs["organizations"][0]["id"];
			return $this->hubstaff_api->find_org_projects($id);
		}
		public function find_org_members()
		{
			$orgs = $this->organizations();
			$id = $orgs["organizations"][0]["id"];
			return $this->hubstaff_api->find_org_members($id);
		}
	}

?>