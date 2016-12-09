<?php
	//check command
	if(!isset($_REQUEST['cmd'])){
		echo '{"result":0, "message":"command not provided"}';
		exit();
	}
	
	//get command
	$cmd=$_REQUEST['cmd'];
	switch($cmd)
	{	
		case 0:
			getUsers();
			break;
		case 1:
			disableUser();
			break;
		default:
			echo '{"result":0, "message":"wrong command"}';
			break;
	}
	
	/**
	*get all users
	*/
	function getUsers(){
		include_once("admin.php");
		$users = new admin();
		$users->getUsers();
		$userdetails = $users->fetch();
		if($userdetails==null){
			echo '{"result":0, "message":"No users"}';
		}
		else{
			echo '{"result":1,"user":[';
			while ($userdetails != false) {
				echo json_encode($userdetails);
				$userdetails = $users->fetch();
					if ($userdetails) {
						echo ',';
					}
			}
			echo ']}';
		}
			
			// $jsonres = array();
		// while($userdetails){
			// array_push($jsonres,$userdetails);
			// echo json_encode($userdetails);
			// $userdetails = $users->fetch();
		// }
			
		}
	
	function disableUser(){
		if(!isset($_REQUEST['id'])){
		echo '{"result":0, "message":"id not provided"}';
		exit();
	}
		$userid = $_REQUEST['id'];
		
		include_once("admin.php");
		$users = new admin();
		$authenticate = $users->disableUser($userid);
		if($authenticate==0){
			echo '{"result":0, "message":"User not disabled"}';
		}
		else
		{
			echo '{"result":1, "message":"User successfully disabled"}';
		}
	}
	
	function enableUser(){
		if(!isset($_REQUEST['id'])){
		echo '{"result":0, "message":"id not provided"}';
		exit();
	}
		$userid = $_REQUEST['id'];
		
		include_once("admin.php");
		$users = new admin();
		$authenticate = $users->enableUser($userid);
		if($authenticate==0){
			echo '{"result":0, "message":"User not disabled"}';
		}
		else
		{
			echo '{"result":1, "message":"User successfully disabled"}';
		}
	}
?>