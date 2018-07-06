<?php
$username = $_POST['username'];
$name = $_POST['fname_lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$error=0;
if($username==""){
	$error=1;
}
if(isset($_GET['uid'])){
	$uid = $_GET['uid'];
}else{
	$uid = 'error';
}
include_once("configs/config.db.php");
$password = secured_hash($password);
$sql___ = "SELECT * FROM user WHERE username = '$username' AND user_id != $uid";
$result1 = mysqli_query($con__,$sql___);
$row = $result1->num_rows;
if(!$row&&$error==0){
	$sql_comm = "UPDATE user SET username = '$username', `password` = '$password', `email` = '$email', `type` = 'user', `name` = '$name' WHERE `user_id` = $uid;
	";
	$result = mysqli_query($con__,$sql_comm);
	if($result){
		?>
		<div class="ui icon message">
			<i class="notched circle loading icon"></i>
			<div class="content">
				<div class="header">
					เสร็จสิ้น
				</div>
				<p>
					แก้ไขบัญชีผู้ใช้สำเร็จ กรุณารอสักครู่
				</p>
			</div>
		</div>
		<script type="text/javascript">
			window.setTimeout(function(){
        // Move to a new location or you can do something else
        window.location.href = "index.php?index=main&userac=createmem";

    }, 1000);

</script>
<?php
}else{
	?>
	<div class="ui icon message">
		<i class="notched circle loading icon"></i>
		<div class="content">
			<div class="header">
				Error
			</div>
			<p>
				เกิดข้อผิดพลาด
			</p>
		</div>
	</div>
	<script type="text/javascript">
		window.setTimeout(function(){
			window.history.back();

		}, 1000);

	</script>
	<?php
}
}else{
	//echo "ไม่สามารใช้ชื่อบัญชีนี้ได้ เนื่องจากมีชื่อบัญชีนี้อยู่แล้ว";
	?>
	<div class="ui icon message">
		<i class="notched circle loading icon"></i>
		<div class="content">
			<div class="header">
				Error
			</div>
			<p>
				ไม่สามารใช้ชื่อบัญชีนี้ได้ เนื่องจากมีชื่อบัญชีนี้อยู่แล้ว
			</p>
		</div>
	</div>
	<script type="text/javascript">
		window.setTimeout(function(){
			window.history.back();

		}, 1000);

	</script>
	<?php
}
function secured_hash($input)
{   
	$output = password_hash($input,PASSWORD_DEFAULT);
	return $output;
}
?>