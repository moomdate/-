<?php
$username = $_POST['username'];
$fnamelname = $_POST['fname_lname'];
$email = $_POST['email'];
$password = $_POST['password'];
include_once("configs/config.db.php");
$sql_Comm = "SELECT * FROM `user` WHERE `username` LIKE '$username'";
$result1 = mysqli_query($con__,$sql_Comm);
$password = secured_hash($password);
//$row =  mysqli_num_rows($result);
if($result1->num_rows){
	echo "มีผู้ใช้นี้แล้ว";
}else{
	$sql_comm = "INSERT INTO `user` (`username`, `password`, `email`, `type`,  `name`) VALUES ('$username', '$password', '$email', 'user', '$fnamelname');";
	$result = mysqli_query($con__,$sql_comm);
	if($result){
		//echo "ok";
		header("location:index.php?index=main&userac=createmem");
	}else{
		echo "error insert";
	}
}
function secured_hash($input)
{   
	$output = password_hash($input,PASSWORD_DEFAULT);
	return $output;
}
?>