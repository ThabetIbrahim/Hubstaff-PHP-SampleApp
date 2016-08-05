<?php 
	namespace Hubstaff
	{
		include("config.php");
		class Client
		{
			function __construct($app_token) {
				$_SESSION['App-Token'] = $app_token;
				if(!isset($_SESSION['Auth-Token']))
				{
					if(is_file($_SESSION['root']."store/auth.txt"))
					{
						if(filesize("store/auth.txt") > 0)
						{
							$auth_token_file = fopen("store/auth.txt","r");
							$_SESSION['Auth-Token'] = fread($auth_token_file,$_SESSION['root'].filesize("store/auth.txt"));						
						}
	
					}
				}
					
			}	
			public function auth($email, $password)
			{
				$auth = new Client\userauth;
				if(!is_dir($_SESSION['root']."store"))
				{
					$auth_token["error"] = "Please create the store directory with 777 permission";
					return $auth_token;
				}
				$auth_token = $auth->auth($_SESSION['App-Token'], $email, $password, BASE_URL.AUTH);
				if(isset($auth_token["error"]))
				{
					return $auth_token["error"];
				}
				$_SESSION['Auth-Token'] = $auth_token["auth_token"];
				if(!is_file($_SESSION['root']."store/auth.txt"))
				{			
					$auth_token_file = fopen($_SESSION['root']."store/auth.txt","w");
					chmod($_SESSION['root']."store/auth.txt",0600);					
				}	
				else 
				{
					$auth_token_file = fopen($_SESSION['root']."store/auth.txt","w");
				}
				fwrite($auth_token_file,$auth_token["auth_token"]);
				return 	$auth_token;
			}
			public function users($organization_memberships = 0, $project_memberships = 0, $offset = 0)
			{
				$users = new Client\users;
				return $users->getusers($organization_memberships, $project_memberships, $offset, BASE_URL.USERS);
			}
			
			public function find_user($id)
			{
				$users = new Client\users;
				return $users->find_user(sprintf(BASE_URL.FIND_USER,$id));
			}
			public function find_user_orgs($id,$offset = 0)
			{
				$users = new Client\users;
				$users->find_user_orgs($offset, sprintf(BASE_URL.FIND_USER_ORG,$id));
			}
			public function find_user_projects($id,$offset = 0)
			{
				$users = new Client\users;
				return $users->find_user_projects($offset, sprintf(BASE_URL.FIND_USER_PROJ,$id));
			}
	
			public function organizations($offset = 0)
			{
				$organizations = new Client\organizations;
				return $organizations->getorganizations($offset,BASE_URL.ORGS);
			}
			
			public function find_organization($id)
			{
				$organizations = new Client\organizations;
				return $organizations->find_organization(sprintf(BASE_URL.FIND_ORG,$id));
			}
			public function find_org_projects($id,$offset = 0)
			{
				$organizations = new Client\organizations;
				return $organizations->find_org_projects($offset, sprintf(BASE_URL.FIND_ORG_PROJ,$id));
			}
			public function find_org_members($id,$offset = 0)
			{
				$organizations = new Client\organizations;
				return $organizations->find_org_members($offset, sprintf(BASE_URL.FIND_ORG_MEMBERS,$id));
			}
	
			public function projects($active = '', $offset = 0)
			{
				$projects = new Client\projects;
				return $projects->getprojects($active,$offset,BASE_URL.PROJS);
			}
			
			public function find_project($id)
			{
				$projects = new Client\projects;
				return $projects->find_project(sprintf(BASE_URL.FIND_PROJ,$id));
			}
			
			public function find_project_members($id,$offset = 0)
			{
				$projects = new Client\projects;
				$projects->find_project_members($offset, sprintf(BASE_URL.FIND_PROJ_MEMBERS,$id));
			}
	
			public function activities($start_time, $stop_time, $offset = 0, $options = array())
			{
				$activities = new Client\activities;
				return $activities->getactivities($start_time, $stop_time, $offset = 0, $options ,BASE_URL.ACTIVITIES);
			}
	
			public function screenshots($start_time, $stop_time, $offset = 0, $options = array())
			{
				$screenshots = new Client\screenshots;
				return $screenshots->getscreenshots($start_time, $stop_time, $offset = 0, $options ,BASE_URL.SCREENSHOTS);
			}
	
			public function notes($start_time, $stop_time, $offset = 0, $options = array())
			{
				$notes = new Client\notes;
				return $notes->getnotes($start_time, $stop_time, $offset = 0, $options ,BASE_URL.NOTES);
			}
	
			public function find_note($id)
			{
				$projects = new Client\notes;
				return $projects->find_note(sprintf(BASE_URL.FIND_NOTE,$id));
			}
	
			public function weekly_team($options = array())
			{
				$weekly = new Client\weekly;
				return $weekly->weekly_team($options, BASE_URL.WEEKLY_TEAM);
			}
			public function weekly_my($options = array())
			{
				$weekly = new Client\weekly;
				return $weekly->weekly_my($options, BASE_URL.WEEKLY_MY);
			}
	
			public function custom_date_team($start_date, $end_date, $options = array())
			{
				$custom = new Client\custom;
				return $custom->custom_report($start_date, $end_date, $options, BASE_URL.CUSTOM_DATE_TEAM);
			}
	
			public function custom_date_my($start_date, $end_date, $options = array())
			{
				$custom = new Client\custom;
				return $custom->custom_report($start_date, $end_date, $options, BASE_URL.CUSTOM_DATE_MY);
			}
			public function custom_member_team($start_date, $end_date, $options = array())
			{
				$custom = new Client\custom;
				return $custom->custom_report($start_date, $end_date, $options, BASE_URL.CUSTOM_MEMBER_TEAM);
			}
			public function custom_member_my($start_date, $end_date, $options = array())
			{
				$custom = new Client\custom;
				return $custom->custom_report($start_date, $end_date, $options, BASE_URL.CUSTOM_MEMBER_MY);
			}
			public function custom_project_team($start_date, $end_date, $options = array())
			{
				$custom = new Client\custom;
				return $custom->custom_report($start_date, $end_date, $options, BASE_URL.CUSTOM_PROJECT_TEAM);
			}
			public function custom_project_my($start_date, $end_date, $options = array())
			{
				$custom = new Client\custom;
				return $custom->custom_report($start_date, $end_date, $options, BASE_URL.CUSTOM_PROJECT_MY);
			}
	
		}
	}

?>