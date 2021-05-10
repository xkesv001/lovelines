<?php
$result_rows = 0;
if (isset($_SESSION['username'])){
	
	$username = $_SESSION['username'];
	$result = $mysqli -> query("SELECT line_name, source_station, target_station FROM `history` WHERE username = '$username'");

}
?>