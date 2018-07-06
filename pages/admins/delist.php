<?php
@session_start();
include_once("configs/config.db.php");
if(isset($_GET['fid']))
	$fid = $_GET['fid'];
else
	$fid = "";
$sql_sss = "DELETE FROM `lists` WHERE `list_ID` = $fid ";
$result = mysqli_query($con__,$sql_sss);
if($result){
	?>
	<div class="ui icon message">
		<i class="notched circle loading icon"></i>
		<div class="content">
			<div class="header">
				เสร็จสิ้น
			</div>
			<p>
				ลบรายการแจ้งซ่อมเสร็จสิ้น กรุณารอสักครู่
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