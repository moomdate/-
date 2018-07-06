<?php
include_once("configs/config.db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.css">
	<title>แบบฟอร์มแจ้งซ่อม</title>
	<style type="text/css">
	body {
		margin: 0;
		padding: 0;
		background-color: #FAFAFA;
		font: 12pt "Tahoma";
		height: 100%;
	}
	* {
		box-sizing: border-box;
		-moz-box-sizing: border-box;
	}
	.page {
		width: 21cm;
		min-height: 29.7cm;
		padding: 2cm;
		margin: 1cm auto;
		border: 1px #D3D3D3 solid;
		border-radius: 5px;
		background: white;
		box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
	}
	.subpage {
		padding: 1cm;
		border: 5px red solid;
		height: 256mm;
		outline: 2cm #FFEAEA solid;
	}
	.border{
		border: 1px solid black;
		height: 100%;
		padding: 10px;
	}
	@page {
		size: A4;
		margin: 5% 5% 5% 5%;  
	}
	@media print {
		html, body {
			width: 210mm;
			height: 297mm;
		}
		#non-printable {
			display:none
		}
		/* ... the rest of the rules ... */
	}
</style>

</head>
<body>
	<div id="non-printable">
		<center><button onclick="print_()" class="ui button blue  ">Print</button></center>
	</div>
	<script>
		function print_() {
			window.print();
		}
	</script>
	<?php
	if(isset($_GET['fid'])){
		$fid = $_GET['fid'];
	}else{
		$fid = 0;
	}
	$sql_comm = "SELECT * FROM lists INNER JOIN user ON lists.list_user_id = user.user_id WHERE list_ID = $fid";
	$data = mysqli_query($con__,$sql_comm);
	while($str= mysqli_fetch_array($data)){

		?>
		<div>
			<center><h2>แบบฟอร์มแจ้งซ่อม</h2></center>
		</div>
		<br><br><br>

		<div>
			<u><h4>ข้อมูลผู้แจ้ง</h4></u>
		</div>
		<br>
		<div>

			<p>ชื่อผู้แจ้ง : <?=$str['name']?></p>
			<p>E-mail : <?=$str['email']?></p>
		</div>
		<hr>
		<div>
			<u><h4>ข้อมูลปัญหา</h4></u>
		</div>
		<br>
		<div>
			<p>หมวดหมู่งานหลัก : <?=$str['list_main']?></p>
			<p>หมวดหมู่งานย่อย : <?=$str['list_sec']?></p>
			<p>อาการ/ปัญหา : <?=$str['list_prob']?></p>
			<p>วัน/เวลาที่แจ้งซ่อม : <?=$str['list_date_in']?></p>
			<p>วัน/เวลาที่นัดซ่อม : <?=$str['list_date_out']?></p>
			<p>กรณีที่ผู้แจ้งไม่อยู่ห้องอนุญาตให้เนินการแก้ไข: <?php
			if($str['list_approve']==1)
				echo "อนุญาต";
			else
				echo "ไม่อนุญาต";
			?>

			</p>
		</div>
		<?php
	}
	?>
	<hr>
	<table id="print-table" style="font-size:16px;text-align:center;margin-top:90px;" width="100%">
		<tbody><tr>
			<td style="width:40%">ลงชื่อ...............................................</td>
			<td style="width:20%"></td>
			<td style="width:40%">ลงชื่อ...............................................</td>
		</tr>
		<tr>
			<td style="width:40%;padding-top:15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(...............................................)</td>
			<td style="width:20%;padding-top:15px"></td>
			<td style="width:40%;padding-top:15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(...............................................)</td>
		</tr>
		<tr>
			<td style="width:40%">ชื่อผู้แจ้ง</td>
			<td style="width:20%"></td>
			<td style="width:40%">ผู้ดำเนินการ</td>
		</tr>
	</tbody></table>
</body>

</html>
<?php
include_once('systems/noneauth.php');
?>