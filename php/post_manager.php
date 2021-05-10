<?php
require "kitlab_db.php";
$mysqli = new mysqli('localhost', $uzivatel, $heslo, $databaze);
$mysqli->query("SET NAMES utf8");

if (isset($_POST)) {
    $method = $_POST["method"];
    // echo $_POST["username"];
    // $resp = (string)"";
    // foreach(array_keys($_POST) as $paramName){
    // 	$resp = $resp.$paramName.' ';
    // }
    // echo $resp;

    switch($method) {
        case "add_like":
        	try{
	        	$line = (string)$_POST['line'];
	        	$username = (string)$_POST['username'];
	        	$from = (string)$_POST['smer_from'];
	        	$to = (string)$_POST['smer_to'];
	        	$t_from = (string)$_POST['t_from'];
	        	$t_to = $_POST['t_to'];
	        	$arr = array('line' => $line, 'username' => $username);
	        	echo json_encode($arr);
        	}catch (Exception $e){
        		$arr = array('status' => 'error', 'error' => ''.$e->getMessage());
        		echo json_encode($arr);
        	}

        	try{
	        	if (!$mysqli -> query( "INSERT INTO `favorites` (username, line_name, smer_from, smer_to, time_from, time_to) VALUES ('$username','$line', '$from', '$to', '$t_from', '$t_to')")){
	                if ($mysqli->errno == 1062) {
	                }
	                else{
	                	$arr = array('status' => 'error', 'error' => ''.$mysqli -> error);
	            		echo json_encode($arr);
	                }
	                
	              }

	          }catch (Exception $e){
	          	$arr = array('status' => 'error', 'error' => ''.$e->getMessage());
	        	echo json_encode($arr);
	          }
            break;

        case "get_likes":
	        $username = (string)$_POST['username'];
	        	$sql = "SELECT username, line_name, smer_from, smer_to, time_from, time_to FROM `favorites` WHERE username = '$username'";
	            $result = mysqli_query($mysqli, $sql) or die("Error in Selecting " . mysqli_error($connection));
	            $rows = array();
	            while($row =mysqli_fetch_assoc($result))
			    {
			        $rows[] = $row;
			    }
	            $resp = json_encode($rows);
	            echo $resp;
            break;
        case "add_comment":
        	try{
	        	$line = (string)$_POST['line_name'];
	        	$username = (string)$_POST['username'];
	        	$comment = (string)$_POST['comment'];

        	}catch (Exception $e){
        		$arr = array('status' => 'error', 'error' => ''.$e->getMessage());
        		echo json_encode($arr);
        	}
            try{
	        	if (!$mysqli -> query( "INSERT INTO `comments` (username, line_name, comment) VALUES ('$username','$line', '$comment')")){
	                if ($mysqli->errno == 1062) {
	                }
	                else{
	                	$arr = array('status' => 'error', 'error' => ''.$mysqli -> error);
	            		echo json_encode($arr);
	                }
	                
	              }

	          }catch (Exception $e){
	          	$arr = array('status' => 'error', 'error' => ''.$e->getMessage());
	        	echo json_encode($arr);
	          }
            break;
        case "get_comments":
            $line_name = (string)$_POST['line_name'];
	        	$sql = "SELECT username, line_name, comment FROM `comments` WHERE line_name = '$line_name'";
	            $result = mysqli_query($mysqli, $sql) or die("Error in Selecting " . mysqli_error($connection));
	            $rows = array();
	            while($row =mysqli_fetch_assoc($result))
			    {
			        $rows[] = $row;
			    }
	            $resp = json_encode($rows);
	            echo $resp;
            break;

        default:
            echo "method : ".$method." is not implemented.";

    };

}
else{
    foreach(array_keys($_POST) as $paramName){
        echo $paramName . "<br>";
    };

    echo "method is not set, cannot continue";
    exit();
};

// if ($response === false) {
//             $arr = array('status' => 'error', 'error' => $response);
//             echo json_encode($arr);
// }
// else{
// 	echo $response;
// }


?>