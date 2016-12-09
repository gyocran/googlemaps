<?php

include_once ("adb.php");

/**
 * login class
 */
class register extends adb {

    /**
     * constructor
     */
    function __construct() {
        
    }
	
    function userRegister($username,$firstname,$lastname,$password,$telephone) {
		// $areacode = '233';
		// $telephone = substr($telephone,1);
		// $telephone = $areacode . $telephone;
        $str_query = "INSERT INTO user set username ='$username', firstname = '$firstname', lastname = '$lastname', password = '$password', telephone = '$telephone'";
        return $this->query($str_query);
    }

}

?>