<?php
@session_start();
include_once('configs/config.db.php');
$haveData = 0;

$username = isset($_POST['username'])==1?$_POST['username']:"";
$password = isset($_POST['password'])==1?$_POST['password']:"";
//echo $username."<br>".$password;
$query = "SELECT * FROM user WHERE username='$username'";
$data = mysqli_query($con__,$query);

	$haveData = mysqli_num_rows($data);
	$data = mysqli_query($con__,$query);

if($haveData==1){
	while($array_data = mysqli_fetch_array($data)){
		//echo $array_data['password'];
		if(password_verify($password,$array_data['password'])){
			//echo "ok";
			//echo $array_data['type'];
		}
		if($array_data['type']=='admin'){
			echo "is admin";
			$_SESSION['admin'] = $array_data ;

		}else{	
			//echo "is user";
			$_SESSION['user'] = $array_data ;
			//header("location:index.php?index=lists");
		}
		header("location:index.php?index=main&userac=lists");
		
	}
}else{
	header("location:index.php?index=signin");
}
/*while($array_data = mysqli_fetch_array($data)){
	print($array_data['username']);
}
echo $data__ = secured_hash($password);
*/
function secured_hash($input)
{   
	$output = password_hash($input,PASSWORD_DEFAULT);
	return $output;
}
//if(password_verify($password,$data__))	
?>