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
        login();
        break;
}


/**
 * function to authenticate user
 */
function login() {

    // checking if username has been entered and store the username and password
    if (isset($_REQUEST['username'])) {
        $username = $_REQUEST['username'];
        $password = $_REQUEST['pword'];

        include_once 'login.php';

        $log = new login();
        $authenticate = $log->userLogin($username, $password);

        // checking if bookings have been gotten from database
        if (!$authenticate) {
            echo '{"result":0,"message":"Error authenticating"}';
            return;
        }

        $row = $log->fetch();
        if (!$row) {
            echo '{"result":0,"message":"username or password is wrong"}';
            return;
        } else {
			// $id = $row['id'];
			// print_r(array_values($row));
            echo '{"result":1,';
            echo '"message": "user authenticated",';
			echo "\"user_id\": {$row['id']},";
			echo "\"user_firstname\": \"{$row['firstname']}\",";
			echo "\"user_status\": \"{$row['status']}\",";
			echo "\"user_type\": \"{$row['type']}\"";
            echo '}';
			// echo json_encode($row);
        }
    }
    
 
}

?>