<?php

//check command
if (!isset($_REQUEST['cmd'])) {
    echo "Command is not provided";
    exit();
}
/* get command */
$cmd = $_REQUEST['cmd'];

switch ($cmd) {
	case 1:
        createPool();
        break;
	case 2:
        joinPool();
        break;
    case 3:
        getPools();
        break;
}

function createPool(){
	
	$user_id = $_REQUEST['user_id'];
	$maxpoolsize = $_REQUEST['maxpoolsize'];
	$price = $_REQUEST['price'];
	$departuretime = $_REQUEST['departuretime'];
	
	include_once 'pool.php';
	$result = new pool();
	
	if ($result->createPool($user_id,$maxpoolsize,$price,$departuretime)) {
        echo '{"result":1, "message":"Pool Created"}';
        return;
    }
	else{
		'{"result":0, "message":"Pool creation failed"}';
	}
	$phoneNumb = '+233246540165'; // send to my phone for test
	$senderName = "pool app"; // name of app
	$message = "pool created!"; // message
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

	$result = curl_exec($ch);
	curl_close($ch);
	}

function joinPool(){
	if(!isset($_REQUEST['poolId'])){
			echo  '{"result":0, "message":"Pool id not provided"}';
			exit();
		}
	
	$pool_id = $_REQUEST['poolId'];
	
	include_once 'pool.php';
	$result = new pool();
	$authenticate = $result->joinPool($pool_id);
	
	if (!$authenticate) {
            echo '{"result":0, "message":"retrieval failed"}';
            return;
        }
	
	$row = $result->fetch();
	if (!$row) {
            echo '{"result":0, "message":"unable to retrieve data"}';
            return;
    } else {
		echo json_encode($row);
		return;
	}
}

function getPools() {
        include_once 'pool.php';

        $result = new pool();
        $authenticate = $result->getPools();

        if (!$authenticate) {
            echo "Error getting pool data";
            return;
        }

        $row = $result->fetch();
        if (!$row) {
            echo "unable to get pool data";
            return;
        } else {
			echo '{"result":1,"pool":[';
			while ($row) {
				echo json_encode($row);
				$row = $result->fetch();
					if ($row) {
						echo ',';
					}
			}
			echo ']}';
			}
        }
    
?>