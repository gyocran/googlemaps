<?php

//check command
if (!isset($_REQUEST['cmd'])) {
    echo "Command is not provided";
    exit();
}
/* get command */
$cmd = $_REQUEST['cmd'];

switch ($cmd) {
    case 3:
        register();
        break;
	case 4:
        sendsms('233246540165','george.o');
		break;
}


/**
 * function to authenticate user
 */
function register() {
        $username = $_REQUEST['username'];
		$firstname = $_REQUEST['firstname'];
		$lastname = $_REQUEST['lastname'];
		$password = $_REQUEST['password'];
		$telephone = $_REQUEST['telephone'];
		$areacode = '233';
		$telephone = substr($telephone,1);
		$telephone = $areacode . $telephone;
		include_once 'register.php';
		$result = new register();
		// echo $result;
		$authenticate = $result->userRegister($username,$firstname,$lastname,$password,$telephone);
		if ($authenticate==0) {
			echo '{"result":0, "message":"Failed to add user"}';
		return;
		}
		else {
			$smsstatus = sendsms($telephone,$username);
			if($smsstatus==0)
				echo '{"result":1, "message":"User successfully added","sms":"sms succeeded"}';
			else if($smsstatus==1)
				echo '{"result":1, "message":"User successfully added","sms":"sms failed"}';
				// echo '{"result":1, "message":"sms will send"}';
			return;
		}
    }

function sendsms($phoneNumb,$user){
	$senderName = "locateAll App";
	$message = "Welcome to locateAll, $user! We hope you enjoy our services!";
	$url = "http://52.89.116.249:13013/cgi-bin/sendsms?username=mobileapp&password=foobar&to=$phoneNumb&from=$senderName&text=$message";

//curl operation
	$ch = curl_init();

//in case connection fails
	if ($ch === false) {
		echo "Failed to connect";
		return;
	}

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
	session_write_close();
	$result = curl_exec($ch);
// echo $result;
	curl_close($ch);
	return $result;
}
?>