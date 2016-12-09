<?php

include_once ("adb.php");

/**
 * login class
 */
class login extends adb {

    /**
     * constructor
     */
    function __construct() {
        
    }

    function userLogin($username, $password) {
        $str_query = "select * from user WHERE username='$username' and password='$password'";

        return $this->query($str_query);
    }

}

?>