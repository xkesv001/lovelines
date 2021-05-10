<?php
$result_rows = 0;
if (isset($_SESSION['username'])){
	
	$username = $_SESSION['username'];
	$result = $mysqli -> query("SELECT username, line_name, smer_from, smer_to, time_from, time_to FROM `favorites` WHERE username = '$username'");

}
?>