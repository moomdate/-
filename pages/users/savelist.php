<?php
@session_start();
if(isset($_SESSION['user'])){
	$dateIn = $_POST['dateIn'];
	$mainTopic = $_POST['mainTopic'];
	$secTopic = $_POST['secTopic'];
	$problem = $_POST['problem'];
	$dateOut = $_POST['dateOut'];

	$approve = $_POST['approve']=='true'?1:0;

	$userID = $_SESSION['user']['user_id'];
	include_once('../../configs/config.db.php');
	$sql_comm="INSERT INTO `lists` (`list_ID`, `list_main`, `list_sec`, `list_prob`, `list_date_in`, `list_date_out`, `list_approve`, `list_user_id`,`list_status`) VALUES ('', '$mainTopic', '$secTopic', '$problem', '$dateIn', '$dateOut', '$approve', '$userID','แจ้งซ่อม');";
	$result = mysqli_query($con__,$sql_comm);
	if($result){
		echo 'ok';
	}else{
		echo "error";
	}

}

?>