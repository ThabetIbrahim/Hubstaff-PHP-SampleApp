<?php 
	namespace Hubstaff\Client
	{
		require_once $_SESSION['root']."helper/curl.php";
		class userauth
		{
	   		public function auth($app_token, $email, $password,$url)
			{

				$fields["App-token"] = $app_token;
				$fields["email"] = $email;
				$fields["password"] = $password;
			
				$parameters["App-token"] = "header";
				$parameters["email"] = "";
				$parameters["password"] = "";
				$curl = new curl;

				$auth_data = json_decode($curl->send($fields, $parameters, $url, 1));
				if(isset($auth_data->user))
				{
					$data['auth_token'] = $auth_data->user->auth_token;				
					$_SESSION['Auth-Token'] = $data['auth_token'];
				}
				else {
					$data['error'] =	$auth_data->error;
				}

				return $data;
			}
			
		}
	
	}
?>