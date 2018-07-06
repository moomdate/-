<?php
include_once('configs/config.db.php');
?>
<div class="ui small breadcrumb">
	<a class="section " href="index.php?index=main&userac=lists">รายการแจ้งซ่อมของฉัน</a>
</div>
<p><h3>รายการแจ้งซ่อมของฉัน</h3></p>
<button class="ui button teal" id="newList"><i class='plus icon'></i>เพิ่มรายการ</button>

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
			<th>พิมพ์</th>
			<th>แก้ไข/ลบ</th>
			
		</tr>
	</thead>
	<tbody>
		<?php
		@session_start();
		$limitPage = 10;
		$page = isset($_GET['page'])?$_GET['page']:1;
		if(!is_numeric($page))
			$page=1;
		$uid = $_SESSION['user']['user_id'];
		//echo $page;

		$query1 = "SELECT * FROM lists WHERE list_user_id='$uid'";
		$data1 = mysqli_query($con__,$query1);
		$pages_ = $data1->num_rows;

		$start_page = (($page-1)*$limitPage);
		$sql_limit_page = "limit $start_page,$limitPage";
		$query = "SELECT * FROM lists WHERE list_user_id='$uid' $sql_limit_page";
		$data = mysqli_query($con__,$query);

		$row = $data->num_rows;
		//echo $row;
		$pages = ceil($pages_/$limitPage);
		
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
				<td>
					<a class="ui blue vertical animated button" tabindex="0" href="print.php?fid=<?=$data_array['list_ID']?>" target="_blank" >
						<div class="hidden content">พิมพ์</div>
						<div class="visible content">
							<i class="print  icon"></i>
						</div>
					</a>
				</td>
				<td>
					<div class="ui input right">
						<a class="ui vertical yellow animated  fade button" tabindex="0" href="index.php?index=main&userac=editform&fid=<?=$data_array['list_ID']?>">
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
				<th colspan="9">
					<div class="ui floated pagination menu">
						<a class="icon item">
							<i class="left chevron icon"></i>
						</a>
						<?php
						for($i=1;$i<$pages+1;$i++){
							if($i==$page)
								print("<a class=\"active item \" href='index.php?index=main&userac=lists&page=$i'>$i</a>");
							else
								print("<a class=\" item \" href='index.php?index=main&userac=lists&page=$i'>$i</a>");
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
							<i class="id card outline icon"></i>
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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!--<link rel="stylesheet" href="/resources/demos/style.css">-->
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="js/jquery.timepicker.min.js"></script>
	<link rel="stylesheet" href="js/jquery.timepicker.min.css">
	<script type="text/javascript">
		$(document).ready(function(){
			$('#resetbtn').click(data=>{
				$('form')[0].reset();
		 	//alert();
		 });
			$('#timeIn').timepicker({ 'timeFormat': 'H:i:s' });
			$('#timeOut').timepicker({ 'timeFormat': 'H:i:s' });

		 /*$('#form__').form({
          fields: {
            username :  {
                        identifier: 'username',
                        rules: [
                          {
                            type   : 'empty',
                            prompt : 'กรุณากรอกชื่อผู้ใช้'
                          }
                        ]
                      }
                  }
              });*/
              $('#saveb').click(data=>{
              	if($('#dateIn').val()==''){
              		$('#dateInd').addClass("error");
              		return false;
              	}else{
              		$('#dateInd').removeClass("error");
              		
              	}

              	if($('#timeIn').val()==''){
              		$('#timeInd').addClass("error");
              		return false;
              	}else{
              		$('#timeInd').removeClass("error");
              		
              	}

              	if($('#sec_').val()==''){
              		$('#sec_d').addClass("error");
              		return false;
              	}else{
              		$('#sec_d').removeClass("error");
              		
              	}

              	if($('#textarea').val()==''){
              		$('#prop_d').addClass("error");
              		return false;
              	}else{
              		$('#prop_d').removeClass("error");
              		
              	}

              	if($('#datepicker2').val()==''){
              		$('#datepicker2_d').addClass("error");
              		return false;
              	}else{
              		$('#datepicker2_d').removeClass("error");
              		
              	}

              	if($('#timeOut').val()==''){
              		$('#timeOut_d').addClass("error");
              		return false;
              	}else{
              		$('#timeOut_d').removeClass("error");
              		
              	}

              	var dateIn = $('#dateIn').val()+" "+$('#timeIn').val();
              	var mainTopic = $('#main_').val();
              	var secTopic =  $('#sec_').val();
              	var problem = $('#textarea').val();
              	var dateOut = $('#datepicker2').val()+ " " +$('#timeOut').val();
              	var approve = $('#check_').is(':checked');
              	//alert(dateIn);
              	$.ajax({
              		type: "POST",
              		url: 'pages/users/savelist.php',
              		data:{
              			dateIn: dateIn,
              			mainTopic:mainTopic,
              			secTopic:secTopic,
              			problem:problem,
              			dateOut:dateOut,
              			approve:approve
              		},
              		success: function(msg){
              			if(msg=='ok'){
              				//$('#tbody').html(response); 
              				// $('.ui.selectable.teal.table').load('index.php?index=main&userac=lists');
              				location.reload();
              				$('.ui.modal').modal('hide');
              				
              				
              			}else{
              				//alert('error');	
              			}
              			
              		},
              		
              	});
              	return false;
              	/*$.post('/pages/users/list.php', {data:'data'}, function(response) {
				    // Log the response to the console
				    console.log("Response: "+response);
				});*/
			});
            //  $('#textarea').val('');
              $('#dateIn').datepicker({ dateFormat: 'yy-mm-dd' });
              $('#datepicker2').datepicker({ dateFormat: 'yy-mm-dd' });
              $('#newList').click(function(){
              	$('.ui.modal').modal('show');
              });

		/*
		$('#Savebtn').click(function(){
			$('.ui.modal').modal('show');

		});

		$('.ui.modal').modal('attach events', '.test.button', function(){
			alert();
		});*/


		$('.ui.modal')
		.modal({
			closable  : false,
			onDeny    : function(){
		     // window.alert('');
		    //  return false;
		},
		onApprove : function() {
		      //window.alert('Approved!');

		    }//
		});
	});
</script>