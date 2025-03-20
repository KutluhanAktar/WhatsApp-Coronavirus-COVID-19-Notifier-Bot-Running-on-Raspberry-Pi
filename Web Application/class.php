<?php

class coronabot {
	public $conn, $previous_data;
	
	public function connect_to_database($DBServerName, $DBUserName, $DBPassword, $DBName){
		$this->conn = mysqli_connect($DBServerName, $DBUserName, $DBPassword, $DBName);
	}
	
	public function create_database_table($table){
		if(!$this->checkTable($table)){
		    $sql = "CREATE TABLE `$table` (
                      sid varchar(255) NOT NULL,
                      token varchar(255) NOT NULL,
                      to_number varchar(255) NOT NULL,
                      from_number varchar(255) NOT NULL,
                     `date` varchar(255) NOT NULL PRIMARY KEY,
                      country varchar(255) NOT NULL,
                      confirmed varchar(255) NOT NULL,
                      recovered varchar(255) NOT NULL
                    );";
			mysqli_query($this->conn, $sql);
			$sql_insert = "INSERT INTO `$table` (`sid`, `token`, `to_number`, `from_number`, `date`, `country`, `confirmed`, `recovered`) VALUES ('default', 'default', 'default', 'default', 'default', 'default', 'default', 'default');";
			mysqli_query($this->conn, $sql_insert);
		}
	}
	
	public function get_previous_data($table){
		$sql = "SELECT * FROM `$table`";
		$result = mysqli_query($this->conn, $sql);
		if(mysqli_num_rows($result) > 0){
			if($rows = mysqli_fetch_assoc($result)){
				$this->previous_data = array(
				           "sid" => $rows["sid"],
				           "token" => $rows["token"],
				           "to_number" => $rows["to_number"],
				           "from_number" => $rows["from_number"],
				           "country" => $rows["country"],
						   "date" => $rows["date"],
				           "confirmed" => $rows["confirmed"],
				           "recovered" => $rows["recovered"]
				       );
			}
		}
		return $this->previous_data;
	}
	
	public function save_new_bot_settings($table, $sid, $token, $to_number, $from_number, $country){
		if(!empty($sid) && !empty($token) && !empty($to_number) && !empty($from_number) && !empty($country)){
			$sql = "UPDATE `$table` SET `sid`='$sid', `token`='$token', `to_number`='$to_number', `from_number`='$from_number', `country`='$country';";
			mysqli_query($this->conn, $sql);
		}
	}
	
	public function save_new_report_data($table, $date, $confirmed, $recovered){
		$sql = "UPDATE `$table` SET `date`='$date', `confirmed`='$confirmed', `recovered`='$recovered';";
		mysqli_query($this->conn, $sql);
	}
	
	private function checkTable($table){
		$sql = "SHOW TABLES FROM `coronabot` LIKE '$table'";
		$checkSql = mysqli_num_rows(mysqli_query($this->conn, $sql));
		if($checkSql < 1){ return false; }else{ return true; }
	}
}

?>