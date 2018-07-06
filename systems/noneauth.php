<?php
@session_start();
if(!(isset($_SESSION['admin'])||isset($_SESSION['user']))){
	header('location:index.php?index=defualt');
//	echo "login!!!<br><br><br><br><br><br><br>admin";
}
?>