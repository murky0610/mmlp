<?php
session_start();

$id = $_SESSION["id"];


Class Action 
{
	private $db;

	public function __construct() {
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	}


	function save_reserve(){
		extract($_POST);

		$price = $qty * $price;

		$data = " movie_id = '".$movie_id."' ";
		$data .= ", ts_id = '".$seat_group."' ";
		$data .= ", id = '".$id."' ";
		// $data .= ", firstname = '".$firstname."' ";
		// $data .= ", contact_no = '".$contact_no."' ";
		$data .= ", qty = '".$qty."' ";
		$data .= ", price = '".$price."' ";
		$data .= ", `date` = '".$showdate."' ";
		$data .= ", `time` = '".$time."' ";

		$save = $this->db->query("INSERT INTO tickets set ".$data);
		if($save){
			return 1;
		}
	}
}

