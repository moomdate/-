
<?php
if(isset($_GET['uid'])){
	$uid = $_GET['uid'];
}else{
	$uid = 'error';
}
include_once("configs/config.db.php");
$sql_q = "SELECT * FROM user WHERE user_id='$uid'";
$sql_query= mysqli_query($con__,$sql_q);
$datauser = mysqli_fetch_assoc($sql_query);
?>
<div class="ui small breadcrumb">
	<a class="section" href="index.php?index=main&userac=createmem">จัดการบัญชีผู้ใข้</a>

	<i class="right chevron icon divider"></i>
	<div class="active section">แก้ไขบัญชีผู้ใช้</div>
</div>
<div class="ui segment">

	<form action="index.php?index=main&userac=saveus&uid=<?=$uid?>" class="ui form column" method="post">

		<div class="ui header">
			แก้ไขบัญชีผู้ใช้
		</div>
		<div class="field">
			<label>บัญชีผู้ใช้</label>
			<div class="ui left icon input">
				<i class="id card outline icon"></i>
				<input type="text" name="username" value="<?=$datauser['username']?>" placeholder="Username">
			</div>
		</div>
		<div class="field">
			<label>ชื่อผู้ใช้</label>
			<div class="ui left icon input">
				<i class="id card outline icon"></i>
				<input type="text" name="fname_lname" value="<?=$datauser['name']?>" placeholder="First name/Last name ">
			</div>
		</div>
		<div class="field">
			<label>E-mail</label>
			<div class="ui left icon input">
				<i class="id card outline icon"></i>
				<input type="text" name="email" value="<?=$datauser['email']?>" placeholder="E-mail">
			</div>
		</div>
		<div class="field">
			<label>รหัสผ่าน</label>
			<div class="ui left icon input">
				<i class="lock icon"></i>
				<input type="password" name="password" value="" placeholder="Password">
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
				username :  {
					identifier: 'username',
					rules: [
					{
						type   : 'empty',
						prompt : 'กรุณากรอกชื่อบัญชีผู้ใช้'
					}
					]
				},
				fname_lname :  {
					identifier: 'fname_lname',
					rules: [
					{
						type   : 'empty',
						prompt : 'กรุณากรอกชื่อผู้ใช้'
					}
					]
				},
				email :  {
					identifier: 'email',
					rules: [
					{
						type   : 'regExp',
						value : /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
						prompt : 'กรุณากรอกอีเมลให้ถูกตัอง'
					}
					]
				},
				password:{
					identifier: 'password',//fname_lname
					rules: [
					{
						type   : 'empty',
						prompt : 'กรุณากรอกรหัสผ่าน'
					},
					{
						type	:"minLength[4]",
						prompt:"รหัสผ่านไม่ควรน้อยกว่า 4 ตัวอักษร"
					}
					]
				}
			}
		});
		
	})
</script>