<?php

include_once ("adb.php");

/**
 * admin class
 */
class admin extends adb {

    /**
     * constructor
     */
    function __construct() {
        
    }

    function getUsers() {
        $str_query = "SELECT * FROM user";
        return $this->query($str_query);
    }
	
	function disableUser($id){
		$str_query = "UPDATE `locateall`.`user` SET `status` = 'Disabled' WHERE `user`.`id` = $id";
		return $this->query($str_query);
	}

	function enableUser($id){
		$str_query = "UPDATE `locateall`.`user` SET `status` = 'Enabled' WHERE `user`.`id` = $id";
		// echo $str_query;
		return $this->query($str_query);
	}
}

?>