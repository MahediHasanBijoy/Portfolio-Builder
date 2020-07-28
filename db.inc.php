<?php 
require_once('config/constant.php');

$db = new mysqli(server,user,password,db_name);
if($db->connect_error){
	exit("cannot connect to database.");
}
// else {
// 	echo "connection successful2";
// }

 ?>