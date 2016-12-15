<?php

//check command
if (!isset($_REQUEST['cmd'])) {
    echo "Command is not provided";
    exit();
}
/* get command */
$cmd = $_REQUEST['cmd'];

switch ($cmd) {
        break;
	case 4:
        sendsms('233246540165','george.o');
		break;
}

function sendsms(){
	$phonenumber = $_REQUEST['phonenumber'];
	$sender = $_REQUEST['sender'];
	$message = $_REQUEST['message'];
	$url = "http://52.89.116.249:13013/cgi-bin/sendsms?username=mobileapp&password=foobar&to=$phonenumber&from=$sender&text=$message";

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