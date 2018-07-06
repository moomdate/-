<?php
include_once('configs/config.db.php');
?>

<?php
$name = isset($_POST['search'])?$_POST['search']:"~";
?>

<div class="ui left aligned grid">
	<div class="left floated left aligned six wide column">
		<div class="ui ">
			<p><h3>รายการแจ้งซ่อมโดยชื่อผู้ใช้</h3></p>
		</div>
	</div>
	<div class="right floated right aligned six wide column">
		<div class="ui ">
			<form class="ui form " method="POST" action="index.php?index=main&userac=state&list=name">
				<div class="ui search " >
					<div class="ui icon input">
						<input class="prompt" name="search" placeholder="ชื่อผู้ใช้" type="text" value="<?=$name?>">
						<i class="search icon"></i>
					</div>
					<div class="results"></div>
					<button class="ui button teal" type="submit"  id="newList">ค้นหา</button>
				</div>
			</form>
		</div>
	</div>
</div>


<table class="ui selectable  teal table">
	<thead>
		<tr>
			<th>วัน/เวลาที่แจ้งซ่อม</th>
			<th>หมวดงานหลัก</th>
			<th>หมวดงานย่อย</th>
			<th>อาการ/ปัญหา</th>
			<th>วัน/เวลาที่นัดซ่อม</th>
			<th>อนุญาตแก้ไข</th>
			<th>สถานะ</th>	
		</tr>
	</thead>
	<tbody>
		<?php
		@session_start();
		$limitPage = 10;
		//echo $name;
		/*if(isset($_POST['search']))
		echo $_POST['search'];*/
		/*if(!is_numeric($name))
			
		$uid = $_SESSION['admin']['user_id'];*/
		//echo $page;
/*
		$query1 = "SELECT * FROM lists WHERE list_user_id LIKE  '%$uid'";
		$data1 = mysqli_query($con__,$query1);
		$pages_ = $data1->num_rows;
*/
		/*$start_page = (($page-1)*$limitPage);
		$sql_limit_page = "limit $start_page,$limitPage";*/
		$query = "SELECT * FROM lists INNER JOIN user ON lists.list_user_id = user.user_id WHERE user.name LIKE '%$name%' ";
		$data = mysqli_query($con__,$query);

		//$row = $data->num_rows;
		//echo $row;
		//$pages = ceil($pages_/$limitPage);
		
		while($data_array = mysqli_fetch_array($data)){


			?>
			<tr>
				<td>
					<div class="ui  label"><?=$data_array['list_date_in']?></div>
				</td>
				<td><?=$data_array['list_main']?></td>
				<td><?=$data_array['list_sec']?></td>
				<td><?=$data_array['list_prob']?></td>
				<td >
					<div class="ui  label"><?=$data_array['list_date_out']?></div>
				</td>
				<td>
					<?php
					if($data_array['list_approve']==1)
						echo "<div class=\"ui green horizontal label\">อนุญาต </div>";
					else
						echo "<div class=\"ui red horizontal label\">ไม่อนุญาต </div>";
					?>

				</td>
				<td>
					<?php
					if($data_array['list_status']=='แจ้งซ่อม')
						echo "<div class=\"ui label yellow\">แจ้งซ่อม</div>";
					else if($data_array['list_status']=='ดำเนินการ')
						echo "<div class=\"ui label teal\">ดำเนินการ</div>";
					else
						echo "<div class=\"ui label green\">สำเร็จ</div>";
					?>
					
				</td>

				
			</tr>
			<?php  } ?>
		</tbody>
		
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
							<textarea id="textarea" ></textarea>
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
