<?php
include_once("configs/config.db.php");
if(isset($_GET['fid'])){
	$fid = $_GET['fid'];
}else{
	$fid = 0;
}

if(isset($_POST['main'])){
	$main_ = $_POST['main'];
}else{
	$main_ = 0;
}
$sql_com = "UPDATE `lists` SET `list_status` = '$main_' WHERE `list_ID` = $fid;";
$result = mysqli_query($con__,$sql_com);
if($result){
?>
	<div class="ui icon message">
		<i class="notched circle loading icon"></i>
		<div class="content">
			<div class="header">
				เสร็จสิ้น
			</div>
			<p>
				แก้ไขสถานะฟอร์มสำเร็จ
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