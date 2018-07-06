<?php
include_once("configs/config.db.php");

if(isset($_GET['fid'])){
	$fid = $_GET['fid'];
}else{
	$fid = 0;
}
$uid = $_SESSION['admin']['user_id'];
$sql_comm = "SELECT * FROM lists WHERE list_ID = $fid ";
$data = mysqli_query($con__,$sql_comm);
$data__ = mysqli_fetch_assoc($data);

?>
<div class="ui small breadcrumb">
	<a class="section" href="index.php?index=main&userac=lists">รายการแจ้งซ่อมทั้งหมด</a>

	<i class="right chevron icon divider"></i>
	<div class="active section">ดำเนินการ</div>
</div>
<div class="ui segment">

	<form action="index.php?index=main&userac=save__&fid=<?=$fid?>" class="ui form column" method="post">

		<div class="ui header">
			สถานะฟอร์มแจ้งซ่อม
		</div>
		<div class="field">
			<label>หมวดหมู่หลัก</label>
			<select class="ui fluid search dropdown" name="main" id="main_" >
				<option value="แจ้งซ่อม"<?php if($data__['list_status']=="แจ้งซ่อม") echo "selected";?>>แจ้งซ่อม</option>
				<option value="ดำเนินการ"<?php if($data__['list_status']=="ดำเนินการ") echo "selected";?>>ดำเนินการ</option>
				<option value="สำเร็จ"<?php if($data__['list_status']=="สำเร็จ") echo "selected";?>>สำเร็จ</option>


			</select>
		</div>

		<div class="ui error message"></div>
		<div class="ui center aligned segment">

			<div class="ui buttons large">
				<button class="ui teal button large" type="submit" ><i class="ui save icon"></i>Save</button>
				<div class="or"></div>
				<button class="ui positive button large"  type="reset"><i class="ui undo icon"></i>Reset</button>
			</div>

		</div>

	</form>
</div>

