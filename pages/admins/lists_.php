<?php
include_once('configs/config.db.php');
		////////////////////////////////////////////////////////count///////////////////////////////////

$r1 = "SELECT * FROM lists INNER JOIN user ON lists.list_user_id = user.user_id";
$d1 = mysqli_query($con__,$r1);
$row_1 = $d1->num_rows;


$r2 = "SELECT * FROM lists INNER JOIN user ON lists.list_user_id = user.user_id WHERE lists.list_status = 'แจ้งซ่อม'";
$d2 = mysqli_query($con__,$r2);
$row_2 = $d2->num_rows;

$r3 = "SELECT * FROM lists INNER JOIN user ON lists.list_user_id = user.user_id WHERE lists.list_status = 'ดำเนินการ'";
$d3 = mysqli_query($con__,$r3);
$row_3 = $d3->num_rows;

$r4 = "SELECT * FROM lists INNER JOIN user ON lists.list_user_id = user.user_id WHERE lists.list_status = 'สำเร็จ'";
$d4 = mysqli_query($con__,$r4);
$row_4 = $d4->num_rows;
		/////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['search'])){
	$search =  $_GET['search'];
	$status = "";
}else
{
	$search = NULL;
	$status = isset($_GET['status'])?$_GET['status']:"";
}
?>
<p><h3 class="ui header blue">รายการแจ้งซ่อมทั้งหมด</h3></p>
<div class="ui segment">
	

	<div class="ui left aligned grid">
		<div class="left floated left aligned six wide column">

			<a href="index.php?index=main&userac=lists&status=all" class="ui">ทั้งหมด <i class="ui teal circular label"><?=$row_1?></i></a><i class="ui angle right icon"></i>
			<a href="index.php?index=main&userac=lists&status=js" class="ui">แจ้งซ่อม <i class="ui yellow circular label"><?=$row_2?></i></a><i class="ui angle right icon"></i>
			<a href="index.php?index=main&userac=lists&status=dk" class="ui">ดำเนินการ <i class="ui blue circular label"><?=$row_3?></i></a><i class="ui angle right icon"></i>
			<a href="index.php?index=main&userac=lists&status=sl" class="ui">สำเร็จ <i class="ui green circular label"><?=$row_4?></i></a>

		</div>
		<div class="right floated right aligned six wide column">
			<div class="ui ">

				<div class="ui search " >

					<div class="ui icon input">
						<input class="prompt" name="search" id="insearch" placeholder="ค้นหาด้วยชื่อผู้ใช้" type="text" value="<?=$search?>">
						<i class="search icon"></i>
					</div>
					<div class="results"></div>
					<button class="ui button teal" id="testtt">ค้นหา</button>
				</div>

			</div>
		</div>
	</div>

</div>
<table class="ui selectable  teal table">
	<thead>
		<tr>
			<th>วัน/เวลาที่แจ้งซ่อม</th>
			<th>หมวดงานหลัก</th>
			<th>หมวดงานย่อย</th>
			<th width="100px">อาการ/ปัญหา</th>
			<th>วัน/เวลาที่นัดซ่อม</th>
			<th>ชื่อผู้ใช้</th>
			<th>อนุญาตแก้ไข</th>
			<th>สถานะ</th>
			<th>พิมพ์</th>
			<th>แก้ไข/ลบ</th>
		</tr>
	</thead>
	<tbody>
		<?php
		@session_start();
		$limitPage = 10;
		$status2 = isset($_GET['status'])?$_GET['status']:"";
		switch ($status) {
			case 'js':
			$status = 'แจ้งซ่อม';
			break;
			case 'dk':
			$status = 'ดำเนินการ';
			break;
			case 'sl':
			$status = 'สำเร็จ';
			break;	
			default:
			$status = 'All';
			break;
		}

		//$statement = "WHERE lists.list_status = '$status'";
		$page = isset($_GET['page'])?$_GET['page']:1;
		if(!is_numeric($page))
			$page=1;
		$uid = $_SESSION['admin']['user_id'];
		if(!$search)
			echo "<h3 class='ui header'>สถานะ:<label class='ui label olive'>$status</label></h3>";
		else
			echo "<h3 class='ui header'>ค้นหาด้วย: ".$search."</h3>";
		if($status=='All')
			$condition = "";
		else
			$condition = "WHERE lists.list_status = '$status'";
		//echo $status;

		if(isset($search)){
			//echo $search;
			$condition = "WHERE user.name LIKE '%$search%'";
			$query1 = "SELECT * FROM lists INNER JOIN user ON lists.list_user_id = user.user_id $condition";
		}else{
			$query1 = "SELECT * FROM lists INNER JOIN user ON lists.list_user_id = user.user_id $condition";
		}

		$data1 = mysqli_query($con__,$query1);
		$pages_ = $data1->num_rows;

		
		$start_page = (($page-1)*$limitPage);
		$sql_limit_page = "limit $start_page,$limitPage ";
		//$query ="SELECT user.user_id, lists.list_main FROM lists INNER JOIN user ON lists.list_user_id = user.user_id;";
		$query = "SELECT * FROM lists INNER JOIN user ON lists.list_user_id = user.user_id $condition $sql_limit_page";
		$data = mysqli_query($con__,$query);
		$pages = ceil($pages_/$limitPage);
		while($data_array = mysqli_fetch_array($data)){


			?>
			<tr>
				<td>
					<?=$data_array['list_date_in']?>
				</td>
				<td><?=$data_array['list_main']?></td>
				<td><?=$data_array['list_sec']?></td>
				<td><?=$data_array['list_prob']?></td>
				<td><?=$data_array['list_date_out']?></td>
				<td><?=$data_array['name']?></td>
				<td>
					<?php
					if($data_array['list_approve']==1)
						echo "<div class=\"ui green horizontal label\">อนุญาต </div>";
					else
						echo "<div class=\"ui red horizontal label\">ไม่อนุญาต </div>";
					?>

				</td>
				<td>
					<label class="ui label
					<?php 
					if($data_array['list_status']=='แจ้งซ่อม'){
						echo "yellow";
					}
					else if($data_array['list_status']=='ดำเนินการ'){
						echo "teal";
					}else{
						echo "green";
					}

					?>
					">
					<?=$data_array['list_status']?>

				</label>
			</td>
			<td>
				<a class="ui vertical animated button blue" tabindex="0" href="print.php?fid=<?=$data_array['list_ID']?>" target="_blank" >
					<div class="hidden content">พิมพ์</div>
					<div class="visible content">
						<i class="print icon"></i>
					</div>
				</a>
			</td>
			<td>
				<div class="ui input right ">
					<a class="ui vertical yellow animated  fade button" tabindex="0" href="index.php?index=main&userac=edit&fid=<?=$data_array['list_ID']?>"  >
						<div class="hidden content">แก้ไข</div>
						<div class="visible content">
							<i class="edit icon"></i>
						</div>
					</a>
					<a class="ui vertical red animated  fade button" tabindex="0" href="index.php?index=main&userac=del&fid=<?=$data_array['list_ID']?>" onclick="return confirm('คุณแน่ใจที่จะลบรายการแจ้งซ่อมนี้');">
						<div class="hidden content">ลบ</div>
						<div class="visible content">
							<i class="trash icon"></i>
						</div>
					</a>
				</div>

			</td>
		</tr>
		<?php  } ?>
	</tbody>
	<tfoot>
		<tr>
			<th colspan="10">
				<div class="ui floated pagination menu">
					<a class="icon item">
						<i class="left chevron icon"></i>
					</a>
					<?php
					for($i=1;$i<$pages+1;$i++){
						if($i==$page){
							if(!$search){
								if($status2!="")
									print("<a class=\"active item \" href='index.php?index=main&userac=lists&status=$status2&page=$i'>$i</a>");
								else
									print("<a class=\"active item \" href='index.php?index=main&userac=lists&page=$i'>$i</a>");
							}else{
								print("<a class=\"active item \" href='index.php?index=main&userac=lists&search=$search&page=$i'>$i</a>");
							}
						}
						else{
							if(!$search){
								if($status2!="")
									print("<a class=\" item \" href='index.php?index=main&userac=lists&status=$status2&page=$i'>$i</a>");
								else
									print("<a class=\" item \" href='index.php?index=main&userac=lists&page=$i'>$i</a>");
							}else{
								print("<a class=\" item \" href='index.php?index=main&userac=lists&search=$search&page=$i'>$i</a>");
							}
						}
					}
					?>

					<a class="icon item">
						<i class="right chevron icon"></i>
					</a>
				</div>
			</th>
		</tr>
	</tfoot>
</table>

<div class="ui modal">
	<div class="header "><i class="plus icon teal"></i>เพิ่มรายการ</div>
	<div class="content">
		<form class="ui form small" method="post" id="form__">

			<div class="ui large stacked segment">
				<div class="two fields">
					<div class="field" id="dateInd">
						<label>วันที่แจ้งซ่อม</label>
						<div class="ui  left icon  input ">
							<i class="add to calendar icon"></i>
							<input type="text" name="dateIn" placeholder="วัน/เวลาที่แจ้งซ่อม" id="dateIn">
						</div>
					</div>
					<div class="field" id="timeInd">
						<label>เวลาที่แจ้งซ่อม</label>
						<div class="ui  icon input">
							<i class="add to calendar icon"></i>
							<input type="text" name="timeIn" placeholder="วัน/เวลาที่แจ้งซ่อม" id="timeIn">
						</div>
					</div>
				</div>
				<div class="field">
					<label>หมวดหมู่หลัก</label>
					<select class="ui fluid search dropdown" name="card[expire-month]" id="main_">
						<option value="อุปกรณ์ไฟฟ้า">อุปกรณ์ไฟฟ้า</option>
						<option value="อุปกรณ์ประปา">อุปกรณ์ประปา</option>
						<option value="อื่นๆ">อื่นๆ</option>


					</select>
				</div>
				<div class="field" id="sec_d">
					<label>หมวดงานย่อย</label>
					<div class="ui left icon input">
						<i class="lock icon"></i>
						<input type="text"  name="type_g" placeholder="หมวดงานย่อย" id="sec_">
					</div>
				</div>
				<div class="field" id="prop_d">
					<label>อาการ/ปัญหา</label>
					<div class="ui input">

						<textarea id="textarea" >

						</textarea>
					</div>
				</div>
				<div class="two fields" id="datepicker2_d">
					<div class="field">
						<label>วันนัดซ่อม</label>
						<div class="ui input">
							<input type="text" id="datepicker2" name="">
						</div>
					</div>
					<div class="field" id="timeOut_d">
						<label>เวลานัดซ่อม</label>
						<div class="ui input">
							<input type="text" id="timeOut" name="">
						</div>
					</div>
				</div>
				<div class="field">
					<div class="ui checkbox">
						<input name="example" type="checkbox" id="check_">
						<label>กรณีที่ผู้แจ้งไม่อยู่ห้องอนุญาตให้ช่างเข้าเนินการได้ทันที</label>
					</div>
				</div>
				<div class="field">
					<input class="ui fluid large teal submit button" type="submit" id="saveb" value="Save">
				</div>
			</div>
			<div class="ui error message"></div>
		</form>
	</div>
	<div class="actions">
		<!--<div class="ui approve button">Approve</div>-->

		<div class="ui green button" id="resetbtn">Reset</div>
		<div class="ui cancel red button">Cancel</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#testtt').click(function(){
			window.location.href = "index.php?index=main&userac=lists&search="+$("#insearch").val();

		});
	});
</script>
