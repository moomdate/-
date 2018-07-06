<?php
include_once("configs/config.db.php");

if(isset($_GET['fid'])){
	$fid = $_GET['fid'];
}else{
	$fid = 0;
}
$uid = $_SESSION['user']['user_id'];
$sql_comm = "SELECT * FROM lists WHERE list_ID = $fid and list_user_id = $uid";
$data = mysqli_query($con__,$sql_comm);
$data__ = mysqli_fetch_assoc($data);

?>
<div class="ui small breadcrumb">
	<a class="section" href="index.php?index=main&userac=lists">รายการแจ้งซ่อมของฉัน</a>

	<i class="right chevron icon divider"></i>
	<div class="active section">แก้ไขแบบฟอร์มแจ้งซ่อม</div>
</div>
<div class="ui segment">

	<form action="index.php?index=main&userac=saveform&fid=<?=$fid?>" class="ui form column" method="post">

		<div class="ui header">
			แก้ไขแบบฟอร์มแจ้งซ่อม
		</div>
		<div class="field">
			<label>หมวดหมู่หลัก</label>
			<select class="ui fluid search dropdown" name="main____" id="main_" >
				<option value="อุปกรณ์ไฟฟ้า"<?php if($data__['list_main']=="อุปกรณ์ไฟฟ้า") echo "selected";?>>อุปกรณ์ไฟฟ้า</option>
				<option value="อุปกรณ์ประปา"<?php if($data__['list_main']=="อุปกรณ์ประปา") echo "selected";?>>อุปกรณ์ประปา</option>
				<option value="อื่นๆ"<?php if($data__['list_main']=="อื่นๆ") echo "selected";?>>อื่นๆ</option>


			</select>
		</div>
		<div class="field">
			<label>หมวดงานย่อย	</label>
			<div class="ui left icon input">
				<i class="id card outline icon"></i>
				<input type="text" name="fname_lname" value="<?=$data__['list_sec']?>" placeholder="First name/Last name ">
			</div>
		</div>
		<div class="field" id="prop_d">
			<label>อาการ/ปัญหา</label>
			<div class="ui input">

				<textarea id="textarea" name="prob"><?=$data__['list_prob']?></textarea>
			</div>
		</div>
		<div class="two fields" id="datepicker2_d">
			<div class="field">
				<label>วันนัดซ่อม</label>
				<div class="ui input">
					<input type="text" id="datepicker2" name="date_" value="<?=explode(' ',$data__['list_date_out'])[0]?>">
				</div>
			</div>
			<div class="field" id="timeOut_d">
				<label>เวลานัดซ่อม</label>
				<div class="ui input">
					<input type="text" id="timeOut" name="time_" value="<?=explode(' ',$data__['list_date_out'])[1]?>">
				</div>
			</div>
		</div>
		<div class="field">
			<div class="ui checkbox">
				<input name="example" type="checkbox" id="check_" <?php if($data__['list_approve']) echo "checked";?>>
				<label>กรณีที่ผู้แจ้งไม่อยู่ห้องอนุญาตให้ช่างเข้าเนินการได้ทันที</label>
			</div>
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

<script type="text/javascript">
	$(document).ready(function(){

		$('.ui.form').form({
			fields: {//textarea
				fname_lname :  {
					identifier: 'fname_lname',
					rules: [
					{
						type   : 'empty',
						prompt : 'กรุณากรอกหมวดหมู่'
					}
					]
				},
				textarea :  {
					identifier: 'textarea',
					rules: [
					{
						type   : 'empty',
						prompt : 'กรุณากรอกปัญหา'
					}
					]
				},
				datepicker2 :  {
					identifier: 'datepicker2',
					rules: [
					{
						type   : 'empty',
						prompt : 'กรุณากรอกวันที่ให้ถูกต้อง'
					}
					]
				},
				timeOut :  {
					identifier: 'timeOut',
					rules: [
					{
						type   : 'empty',
						prompt : 'กรุณากรอกเวลาให้ถูกต้อง'
					}
					]
				}
			}
		});
		
	})
</script>
