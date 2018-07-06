<div class="ui small breadcrumb">
	<a class="section">จัดการบัญชีผู้ใช้</a>
</div>
<table class="ui selectable teal table">
	<h3 class="ui head">จัดการผู้ใช้งาน</h3>
	<a class="ui green button" href="index.php?index=main&userac=create_m"><i class="plus icon"></i>เพิ่ม</a> 
	<thead>
		<tr>
			<th>Username</th>
			<th>Name/Lastname</th>

			<th>email</th>
			<th>edit/delete</th>
		</tr>
	</thead>
	<?php
	include_once("configs/config.db.php");
	$sql_q = "SELECT * FROM user WHERE type='user'";
	$sql_query= mysqli_query($con__,$sql_q);
	while($datauser = mysqli_fetch_array($sql_query)){
		?>
		<tbody>
			<td><?=$datauser['username']?></td>
			<td><?=$datauser['name']?></td>
			
			<td><?=$datauser['email']?></td>
			<td><a class="ui yellow button" href="index.php?index=main&userac=edituser&uid=<?=$datauser['user_id']?>">Edit</a> <a class="ui red button" id="uid<?=$datauser['user_id']?>">Delete</a></td>
		</tbody>
		<?php
	}
	?>
</table>

<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript">
	$('.ui.red.button').click(function(event){
		var uid = $(event.target)[0].id;
		uid = uid.replace('uid','');
		if(uid!=''){
			$.cookie("uid",uid);
			$.cookie("data",makeid());
		}
		
		//alert($.cookie("uid"));
		//this.uid = 'test';
		//this.age = 0;
		//alert($(event.target)[0].id);
		//alert(uid);
		$('.ui.mini.basic.modal')
		.modal({
			closable  : false,
			onDeny    : function(){
				//return false;
			},
			onApprove : function(){
				window.location.href = `index.php?index=main&userac=deluser&uid=${$.cookie("uid")}&cookie=${$.cookie("data")}`;
				//alert("test");
				//alert($.cookie("uid"));
			//window.alert('Approved!');
			/*window.alert('Wait not yet!');
			return false;*/
			//this.close();
		}
	}).modal('show');

	});
	function makeid() {
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

		for (var i = 0; i < 10; i++)
			text += possible.charAt(Math.floor(Math.random() * possible.length));

		return text;
	}
</script>
<div class="ui mini basic modal">
	<div class="ui icon header">
		<i class="trash icon"></i>
		ลบ บัญชีผู้ใช้นี้
	</div>
	<div class="content ">
		คุณแน่ใจหรือไม่ที่จะลบบัญชีผู้ใช้นี้?
	</div>
	<div class="actions">
		<button class="ui approve basic red button"><i class="ui trash icon"></i>ลบ</button>
		<button class="ui cancel basic green button"><i class="ui hand paper icon"></i>ยกเลิก</button>
	</div>
</div>