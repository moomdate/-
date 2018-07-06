<?php
include_once('configs/config.db.php');
$main = $_POST['main____'];
$sec = $_POST['fname_lname'];//
$prob = $_POST['prob'];
$date = $_POST['date_'];
$time = $_POST['time_'];//
if(isset($_POST['example'])){
	$check = 1;
}else{
	$check = 0;
}
$fid = $_GET['fid'];
$dateOut = $date." ".$time;

$sql_comm = "UPDATE `lists` SET `list_main` = '$main', `list_sec` = '$sec ', `list_prob` = '$prob', `list_date_out` = '$dateOut', `list_approve` = '$check' WHERE `lists`.`list_ID` = '$fid'; ";
$result= mysqli_query($con__,$sql_comm);
if($result){
	?>
	<div class="ui icon message">
		<i class="notched circle loading icon"></i>
		<div class="content">
			<div class="header">
				เสร็จสิ้น
			</div>
			<p>
				บันทึกฟอร์มสำเร็จ กรุณารอสักครู่
			</p>
		</div>
	</div>
	<script type="text/javascript">
		window.setTimeout(function(){
        // Move to a new location or you can do something else
        window.location.href = "index.php?index=main&userac=lists";

    }, 1000);

</script>
<?php
}else{
	echo "error";
}
?>