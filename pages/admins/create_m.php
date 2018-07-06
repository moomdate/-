<div class="ui small breadcrumb">
  <a class="section" href="index.php?index=main&userac=createmem">จัดการบัญชีผู้ใช้</a>

  <i class="right chevron icon divider"></i>
  <div class="active section">เพิ่มบัญชีผู้ใช้</div>
</div>
<div class="ui segment">

	<form action="index.php?index=main&userac=savenewuser" class="ui form column" method="post">

		<div class="ui header">
			เพิ่มบัญชีผู้ใช้
		</div>
		<div class="field">
			Username
			<div class="ui left icon input">
				<i class="user icon"></i>
				<input type="text" name="username" placeholder="Username">
			</div>
		</div>
		<div class="field">
			First name/Last name
			<div class="ui left icon input">
				<i class="id card outline icon"></i>
				<input type="text" name="fname_lname" placeholder="First name/Last name ">
			</div>
		</div>
		<div class="field">
			E-mail
			<div class="ui left icon input">
				<i class="mail outline icon"></i>
				<input type="text" name="email" placeholder="E-mail ">
			</div>
		</div>
		<div class="field">
			Password
			<div class="ui left icon input">
				<i class="key icon"></i>
				<input type="password" name="password" placeholder="Password">
			</div>
		</div>
		<div class="ui error message"></div>
		<div class="ui center aligned segment">

			<div class="ui buttons large">
				<button class="ui teal button large" type="submit"><i class="ui save icon"></i>Save</button>
				<div class="or"></div>
				<button class="ui positive button large"  type="reset"><i class="ui undo icon"></i>Reset</button>
			</div>

		</div>

	</form>
</div>
<script type="text/javascript">
	$(document).ready(function(){

		$('.ui.form').form({
			fields: {
				username :  {
					identifier: 'username',
					rules: [
					{
						type   : 'empty',
						prompt : 'กรุณากรอกชื่อผู้ใช้'
					}
					]
				},
				password:{
					identifier: 'password',//fname_lname
					rules: [
					{
						type   : 'empty',
						prompt : 'กรุณากรอกชื่อผู้ใช้'
					},
					{
						type	:"minLength[4]",
						prompt:"รหัสผ่านไม่ควรน้อยกว่า 4 ตัวอักษร"
					}
					]
				},
				fname_lname :  {
					identifier: 'fname_lname',
					rules: [
					{
						type   : 'empty',
						prompt : 'กรุณากรอกชื่อ - นามสกุล'
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
				}

			}
		});

	})
</script>