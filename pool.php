<?php

include_once ("adb.php");

/**
 * login class
 */
class pool extends adb {

    /**
     * constructor
     */
    function __construct() {
        
    }

    function getPools() {
        $str_query = "SELECT carpool_pool.pool_pool_id,carpool_pool.pool_destination,carpool_pool.pool_departure_time,carpool_user.user_username FROM `carpool_user` inner join carpool_pool on carpool_user.user_user_id = carpool_pool.pool_user_id";

        return $this->query($str_query);
    }
	
	function joinPool($poolId) {
        $str_query = "update carpool_pool set pool_current_size = IF(pool_current_size<pool_max_size, pool_current_size + 1, pool_max_size = 0), pool_max_size = IF(pool_current_size=pool_max_size, pool_max_size=0, pool_max_size) WHERE pool_pool_id = $poolId";
		$this->query($str_query);
		$str_query = "SELECT pool_max_size FROM `carpool_pool` WHERE pool_pool_id = $poolId";
		return $this->query($str_query);
        // $max = $this->query($str_query);
		// $max = $this->fetch();
    }
	
	function getUserId($username){
		$str_query = "SELECT user_user_id FROM `carpool_user` WHERE user_username=$username";
		return $this->query($str_query);
	}

	function createPool($user_id,$maxsize,$price,$departuretime) {
		// $res = getUserId($username);
		// $str_query = "SELECT user_user_id FROM `carpool_user` WHERE user_username=$username";
		// $user = $this->query($str_query);
		// $user = $res->fetch();
        $str_query = "INSERT INTO carpool_pool set
						pool_user_id = $user_id,
						pool_max_size = $maxsize,
						pool_price = $price,
						pool_departure_time = '$departuretime'
						";

        return $this->query($str_query);
    }
}

?>